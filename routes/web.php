<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PagesController;

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
 ****   Publish Page   ****
 **************************/
// Publish Page
Route::get(
    '/publish',
    [PostsController::class, 'index']
)->name('publish.index');

// Create and/or Publish posts
Route::post(
    '/publish',
    [PostsController::class, 'store']
)->name('publish.create');

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

// Select some Facebook pages
Route::post(
    '/connect',
    [PagesController::class, 'store']
)->name('connect.select');

// Reconnect to Facebook pages
Route::put(
    '/connect/{id}',
    [PagesController::class, 'update']
)->name('connect.update');

// Delete Facebook pages
Route::delete(
    '/connect/{id}',
    [PagesController::class, 'destroy']
)->name('connect.delete');
