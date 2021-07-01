<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Facebook\Facebook;
use \Facebook\Exceptions\FacebookResponseException;
use \Facebook\Exceptions\FacebookSDKException;

use App\Models\User;

class FacebookController extends Controller
{
    /**
     * An easy interface for working with all the components of the SDK.
     * @var Facebook\Facebook
     */
    private $fb;

    /**
     * Used to generate a "Login with Facebook" link and obtain an access
     * token from a redirect.
     * @var Facebook\Helpers\FacebookRedirectLoginHelper
     */
    private $helper;

    // Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Facebook Login
    public function redirectToFacebook()
    {
        // Optional permissions
        $permissions = ['email', 'user_friends'];
        return $this->__redirect($permissions);
    }

    // Facebook Callback
    public function handleFacebookCallback()
    {
        // Get current User
        $user = User::find($id = auth()->user()->id);

        // Get Facebook User token
        $token = $this->__token();
        // Facebook User Fields
        $fields = ["id", "email", "name", "picture"];
        // Get Facebook User
        $user_fb = $this->__user($fields, $token);

        // Modify the data of the current user
        $user->id_fb = $user_fb->getId();
        $user->token_fb = $token;
        $user->save();

        return redirect()->route("connect.index");
    }

    // Search Facebook Pages by name
    public function search(string $query)
    {
        // Get User token from database
        $user = User::find($id = auth()->user()->id);
        $token = $user->token_fb;

        $this->__config();
        $this->fb->setDefaultAccessToken($token);

        $search = $this->fb->get("/search?q=$query&type=page", $token);
        $search = $search->getGraphEdge()->asArray();

        return $search;
    }

    // Post message on Facebook page.
    public function publish_message($fb_page_id, $token, $message)
    {
        $this->__config();

        $query = '/' . $fb_page_id . '/feed';
        $data = ['message' => $message];

        $this->__post($query, $data, $token);
    }

    // Upload images on Facebook Page.
    public function upload_image($fb_page_id, $token, $image_src, $message)
    {
        $this->__config();

        $query = '/' . $fb_page_id . '/photos';
        $data = [
            'source' => $this->fb->fileToUpload($image_src),
            'message' => $message
        ];

        $this->__post($query, $data, $token);
    }

    // Upload videos on Facebook Page.
    public function upload_video($fb_page_id, $token, $video_src, $description)
    {
        $this->__config();

        $query = '/' . $fb_page_id . '/videos';
        $data = [
            'title' => null,
            'description' => $description,
            'source' => $this->fb->videoToUpload($video_src),
        ];

        $this->__post($query, $data, $token);
    }

    private function __post($query, $data, $token)
    {
        try {
            $post = $this->fb->post($query, $data, $token);
            $post = $post->getGraphNode()->asArray();
            return $post["id"];
        } catch (FacebookResponseException $e) {
            dd('Graph returned an error: ' . $e->getMessage());
        } catch (FacebookSDKException $e) {
            dd('Facebook SDK returned an error: ' . $e->getMessage());
        }
    }

    // Generate the $fb and $helper
    private function __config()
    {
        //session_destroy();
        session_start();

        // Facebook application ID
        $app_id = config('services.facebook.app_id');

        // Facebook application  secret key.
        $app_secret = config('services.facebook.app_secret');

        $this->fb = new Facebook([
            'app_id' => $app_id,
            'app_secret' => $app_secret,
            'default_graph_version' => 'v2.10',
            'persistent_data_handler' => 'session'
        ]);

        $this->helper = $this->fb->getRedirectLoginHelper();
    }

    // Redirect To Facebook with some permissions
    private function __redirect($permissions)
    {
        $this->__config();

        // The redirect URL to your website.
        $redirect = config('services.facebook.redirect');

        // Redirect To Login with Facebook
        $loginUrl = $this->helper->getLoginUrl($redirect, $permissions);
        return redirect($loginUrl);
    }

    // The access token to be used for the request.
    private function __token()
    {
        $this->__config();

        try {
            $token = $this->helper->getAccessToken();
        } catch (FacebookResponseException $e) {
            dd('Graph returned an error: ' . $e->getMessage());
        } catch (FacebookSDKException $e) {
            dd('Facebook SDK returned an error: ' . $e->getMessage());
        }

        if ($token->isLongLived()) {
            return $token;
        }

        $oAuth2Client = $this->fb->getOAuth2Client();
        return $oAuth2Client->getLongLivedAccessToken($token);
    }

    // Get Facebook User Information
    private function __user(array $fields, string $token)
    {
        // Facebook User Fields
        $fields = join(",", $fields);

        $response = $this->fb->get("/me?fields=$fields", $token);
        return $response->getGraphUser();
    }
}
