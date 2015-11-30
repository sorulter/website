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
// Route::get('login', ['as' => 'user/login', 'uses' => 'AuthController@getLogin']);
// Route::post('login', 'AuthController@postLogin');
// Route::get('logout', 'AuthController@getLogout');
// Route::get('register', 'AuthController@getRegister');
// Route::post('register', 'AuthController@postRegister');
Route::get('activate/{code}', 'AuthController@getActivate')->where('code', '[0-9A-Za-z]+');
Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'User', 'as' => 'user'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);
    Route::get('/activate/resent', ['as' => '/activate/resent', 'uses' => 'HomeController@getResentActivateMail']);
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

