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

// Authentication
Auth::routes();

// Account Page
Route::get(
    '/account',
    [App\Http\Controllers\DashboardController::class, 'index']
)->name('account.account');

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
