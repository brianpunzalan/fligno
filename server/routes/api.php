<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    Route::apiResource('user', 'UserController');
    
});

Route::namespace('Auth')->group(function () {
    Route::post('/login', 'LoginController@apiLogin');
});

Route::namespace('Auth')->middleware(['auth:api', 'admin'])->group(function () {
    Route::post('/logout', 'LoginController@apiLogout');
});
