<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SubscriptionController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/sign-in/facebook', [LoginController::class, 'facebook']);
    Route::get('/auth/facebook/callback', [LoginController::class, 'facebookRedirect']);

    Route::get('/sign-in/google', [LoginController::class, 'google']);
    Route::get('/auth/google/callback', [LoginController::class, 'googleRedirect']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/subscribe/{plan_id}', [SubscriptionController::class, 'subscribeTo']);
