<?php

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
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
Route::namespace('Web')->middleware('guest')->group(function () {
    // Custom Registration
    Route::get('/sign-up', 'UserController@showRegisterForm')->name('register');
    Route::post('/sign-up', 'UserController@signUp')->name('register.submit');
    Route::get('/sign-up/success', 'UserController@showRegistrationSuccess')->name('register.success');
});

Route::namespace('Web')->group(function () {
    Route::get('/', 'UserController@index')->name('home');
    Route::get('/user/{id}', 'UserController@show')->name('user.profile'); 
    Route::get('/search', 'UserController@search');
});

// Auth::routes();
Route::namespace('Auth')->group(function () {
    Route::post('/logout', 'LoginController@logout')->name('logout');
});
Route::namespace('Auth')->middleware('guest')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::post('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
});