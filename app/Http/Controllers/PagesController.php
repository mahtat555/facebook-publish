<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;
use Facebook\Facebook;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the User pages.
     */
    public function index()
    {
        $pages = auth()->user()->pages()
            ->orderBy("created_at", "desc")->paginate(5);

        return view("connect.index")->with("pages", $pages);
    }

    /**
     * Search Facebook pages.
     */
    public function search()
    {
        return view("connect.search");
    }

    /**
     * Select Some Facebook pages.
     */
    public function select(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string',
        ]);

        $query = $request->search;
        $facebookController = new FacebookController();
        $pages = $facebookController->search($query);

        return view("connect.select")->with("pages", $pages);
    }

    /**
     * Stored the selected pages in the database.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pages' => 'required|array',
        ]);

        // storage
        foreach ($request->pages as $fb_page_id => $fb_page_name) {
            $page = new Page;
            $page->user_id = auth()->user()->id;
            $page->created_at = now();
            $page->fb_page_id = $fb_page_id;
            $page->fb_page_name = $fb_page_name;
            $page->save();
        }

        return $this->index();
    }

    /**
     * Update the specified Page.
     */
    public function update($id)
    {
        $page = Page::find($id);

        if (isset($page)) {
            $page->created_at = now();
            $page->save();
        }

        return $this->index();
    }

    /**
     * Remove the specified Page.
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if (isset($page)) {
            $page->delete();
        }

        return $this->index();
    }
}
