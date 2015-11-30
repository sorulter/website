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
Route::group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'User', 'as' => 'user'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// test route
Route::get('/view', function () {
    return view('user.test');
});
Route::get('/id', function () {
    // 93c4da84074bc4173a6240f1a29f8f4517d872ec
    $oldid = Session::getId();
    if (Input::has('debug')) {
        Session::setId("93c4da84074bc4173a6240f1a29f8f4517d872ec");
        echo "debug\n";
    }
    if (Input::has('set')) {
        Session::put('user', 'kofj');
    }
    dd(Session::all(), $oldid, Session::getId());
});

// Route::get('/user', ['as' => 'user.dashboard', 'uses' => 'LoginController@index']);
