<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    [App\Http\Controllers\DashboardController::class, 'index']
)->name('account.index');

// Dashboard Page
Route::get(
    '/dashboard',
    [App\Http\Controllers\DashboardController::class, 'dashboard']
)->name('account.dashboard');

// Profile Page
Route::get(
    '/profile',
    [App\Http\Controllers\DashboardController::class, 'profile']
)->name('account.profile');

// Security Page
Route::get(
    '/security',
    [App\Http\Controllers\DashboardController::class, 'security']
)->name('account.security');


/**************************
 ****   Publish Page   ****
 **************************/
// Publish Page
Route::get(
    '/publish',
    fn () => view("publish.index")
    //[App\Http\Controllers\DashboardController::class, 'index']
)->name('publish.index');

Route::post(
    '/publish',
    [App\Http\Controllers\DashboardController::class, 'pub']
);
