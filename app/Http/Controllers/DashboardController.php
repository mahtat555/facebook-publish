<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            "except" => ["index"]
        ]);
    }

    /**
     * Show the account page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }
        return view('account.index');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('account.dashboard');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        return view('account.profile');
    }

    /**
     * For more security.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function security()
    {
        return view('account.security');
    }

    public function pub(Request $request)
    {
        return $request;
    }
}
