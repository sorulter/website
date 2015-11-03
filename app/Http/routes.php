<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', ['as' => 'user/login', 'uses' => 'AuthController@getLogin']);
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@getLogout');
Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'User', 'as' => 'user'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);
});

