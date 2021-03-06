<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Post;
use Facebook\FacebookClient;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the User posts.
     */
    public function index()
    {
        $post = auth()->user()->posts()
            ->orderBy("created_at", "desc")->paginate(6);

        return view("publish.index")->with("posts", $post);
    }

    /**
     * Store a newly created Post in storage.
     */
    public function store(Request $request)
    {
        $this->__validate($request);

        $post = new Post;

        // Storage the data
        $this->__storage($request, $post);

        return $this->index();
    }

    /**
     * Share the Post Now.
     */
    public function share($id)
    {
        $post = Post::find($id);

        // check for the correct User
        if ($this->__checkCorrectUser($post)) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        if (!$post->scheduled) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        $post->scheduled = false;
        $post->created_at = now();
        $post->save();

        // Share it on Facebook
        $this->share_fb($post);

        return $this->index();
    }

    /**
     * Display the specified Post.
     */
    public function show($id)
    {
        $post = Post::find($id);

        // check for the correct User
        if ($this->__checkCorrectUser($post)) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        return view("publish.show")->with("post", $post);
    }

    /**
     * Update the specified Post in storage.
     */
    public function update(Request $request, $id)
    {
        $this->__validate($request);

        $post = Post::find($id);

        // check for the correct User
        if ($this->__checkCorrectUser($post)) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        // We can only update scheduled posts
        if (!$post->scheduled) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Update");
        }

        // Delete the media
        if ($post->type === "Image") {
            Storage::delete("public/images/" . $post->media);
        }
        if ($post->type === "Video") {
            Storage::delete("public/videos/" . $post->media);
        }

        // Storage the data
        $this->__storage($request, $post);

        return $this->index();
    }

    /**
     * Remove the specified Post from storage.
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // check for the correct User
        if ($this->__checkCorrectUser($post)) {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        $post->delete();

        // Remove Media
        if ($post->type === "Video") {
            Storage::delete("public/videos/" . $post->media);
        } else if ($post->type === "Image") {
            Storage::delete("public/images/" . $post->media);
        }

        return $this->index();
    }

    /**
     * Check for the correct User
     */
    private function __checkCorrectUser($post)
    {
        return (!isset($post)) ||
            (auth()->user()->id !== $post->page->user->id);
    }

    /**
     * Get data from User ($request) and
     * Storage the post into Database
     */
    private function __storage($request, $post)
    {
        // Handle social media (Image/Video) upload
        $post->type = "Status";
        $post->media = "null";
        $post->description = $request->description ?? "null";

        if (isset($request->image)) {
            $post->media = "__" . time() . "_"
                . $request->image->getClientOriginalName();
            $post->type = "Image";
        } else {
            if (isset($request->video)) {
                $post->media = "__" . time() . "_"
                    . $request->video->getClientOriginalName();
                $post->type = "Video";
            } else {
                if (!isset($request->description)) {
                    return redirect()->route("publish.index")
                        ->with("error", "This post is empty");
                }
            }
        }

        // Handle Schedule Posts
        $post->created_at = now();

        if (isset($request->schedule)) {
            $post->created_at = $request->schedule;
            $post->scheduled = true;
            if ($post->created_at < now()) {
                $post->created_at = now();
                $post->scheduled = false;
            }
        }

        // Page Id (The page selected to post on)
        if (auth()->user()->hasPage($request->page_id)) {
            $post->page_id = $request->page_id;
        } else {
            return redirect()->route("publish.index")
                ->with("error", "Unauthorized Page");
        }

        $post->save();

        // Upload the Media
        if ($post->type === "Video") {
            $request->video->storeAs("public/videos", $post->media);
        }
        if ($post->type === "Image") {
            $request->image->storeAs("public/images", $post->media);
        }

        // Share the post on Facebook
        if (!$post->scheduled) {
            $this->share_fb($post);
        }
    }

    /**
     * Validate the data in the request.
     */
    private function __validate($request)
    {
        $this->validate($request, [
            'description' => 'max:65535',
            'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm|nullable|max:19999',
            'image' => 'image|nullable|max:1999',
            'page_id' => 'required|exists:pages,id',
            'schedule' => 'date_format:Y-m-d H:i:s'
        ]);
    }

    /**
     * Share the Posts On Facebook.
     */
    public function share_fb($post)
    {
        $fb_controller = new FacebookController;

        $fb_page_id = $post->page->fb_page_id;
        $token = $post->page->user->token_fb;
        $message = $post->description;

        if ($post->type === "Status") {
            // Post message on Facebook Page.
            $fb_post_id =$fb_controller->publish_message($fb_page_id,
                $token, $message);
        }
        elseif ($post->type === "Image") {
            // Upload image on Facebook Page.
            $image_src = "/storage/images/" . $post->media;
            $fb_post_id = $fb_controller->upload_image($fb_page_id, $token,
                $image_src, $message);
        }
        else {
            // Upload video on Facebook Page.
            $video_src = "/storage/videos/" . $post->media;
            $fb_post_id = $fb_controller->upload_video($fb_page_id, $token,
                $video_src, $message);
        }

        $post->fb_post_id = $fb_post_id;
        $post->scheduled = false;
        $post->save();

        return $this->index();
    }
}
