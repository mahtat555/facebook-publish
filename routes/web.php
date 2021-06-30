<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FacebookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Home Page
Route::get('/', function () {
    return view("home");
})->name("home");

/**************************
 ****   Account Page   ****
 **************************/

// Authentication
Auth::routes();

// Account Page
Route::get(
    '/account',
    [DashboardController::class, 'index']
)->name('account.index');

// Dashboard Page
Route::get(
    '/dashboard',
    [DashboardController::class, 'dashboard']
)->name('account.dashboard');

// Profile Page
Route::get(
    '/profile',
    [DashboardController::class, 'profile']
)->name('account.profile');

// Security Page
Route::get(
    '/security',
    [DashboardController::class, 'security']
)->name('account.security');


/**************************
 ****   Publish page   ****
 **************************/
// Publish Page
Route::get(
    '/publish',
    [PostsController::class, 'index']
)->name('publish.index');

// Show specified Post
Route::get(
    '/publish/{id}',
    [PostsController::class, 'show']
)->name('publish.show');

// Create and/or Publish posts
Route::post(
    '/publish',
    [PostsController::class, 'store']
)->name('publish.create');

// Share post on Facebook
Route::post(
    '/publish/{id}',
    [PostsController::class, 'share']
)->name('publish.share');

// Edit and/or Publish posts
Route::put(
    '/publish/{id}',
    [PostsController::class, 'update']
)->name('publish.edit');

// Delete posts
Route::delete(
    '/publish/{id}',
    [PostsController::class, 'destroy']
)->name('publish.delete');


/**************************
 ****   Connect Page   ****
 **************************/
// Connect Page
Route::get(
    '/connect',
    [PagesController::class, 'index']
)->name('connect.index');

// Search Facebook pages
Route::get(
    '/connect/search',
    [PagesController::class, 'search']
)->name('connect.search');

Route::post(
    '/connect/search',
    [PagesController::class, 'select']
);

// Select some Facebook pages
Route::post(
    '/connect/select',
    [PagesController::class, 'store']
)->name('connect.select');

// Reconnect to Facebook pages
Route::put(
    '/connect/{id}',
    [PagesController::class, 'update']
)->name('connect.reconnect');

// Delete Facebook pages
Route::delete(
    '/connect/{id}',
    [PagesController::class, 'destroy']
)->name('connect.delete');

// Login with Facebook
Route::get(
    '/login/facebook',
    [FacebookController::class, "redirectToFacebook"]
)->name("login.facebook");

Route::get(
    '/login/facebook/callback',
    [FacebookController::class, "handleFacebookCallback"]
);
