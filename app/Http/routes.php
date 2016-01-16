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

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('forgot', 'Auth\PasswordController@getEmail');
Route::post('forgot', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('reset/{token}', 'Auth\PasswordController@getReset')->where('token', '[0-9A-Za-z]{64}');
Route::post('reset', 'Auth\PasswordController@postReset');

// Activation routes...
Route::get('activate/{token}', 'Auth\ActivationController@getActivate')->where('token', '[0-9A-Za-z]{60}');
Route::get('activate/resend', ['uses' => 'Auth\ActivationController@getResend']);

// user group routes...
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user'], function () {
    // With auth middleware.
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);

        // Billing routes...
        Route::get('billing', ['as' => '/billing', 'uses' => 'BillingController@getIndex']);
        Route::get('billing/charge', ['as' => '/billing/charge', 'uses' => 'BillingController@getCharge']);
        Route::post('billing/charge', ['as' => '/billing/charge', 'uses' => 'BillingController@postCharge']);
        Route::get('billing/payment', ['as' => '/billing/payment', 'uses' => 'BillingController@getPayment']);
        Route::get('billing/continue/{orderid}', ['as' => '/billing/continue', 'uses' => 'BillingController@getContinue']);

    });

    // Without auth middleware.
    Route::any('billing/result', ['as' => '/billing/result', 'uses' => 'BillingController@result']);

});

Route::group(['prefix' => env('ADMINNS'), 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin', 'as' => 'admin'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);

    Route::get('ports', ['as' => '/ports', 'uses' => 'PortsController@getIndex']);
    Route::get('ports/index/used', ['as' => '/ports/index/used', 'uses' => 'PortsController@getIndexUsed']);
    Route::get('ports/index/empty', ['as' => '/ports/index/empty', 'uses' => 'PortsController@getIndexEmpty']);
    Route::get('ports/add', ['as' => '/ports/add', 'uses' => 'PortsController@getAddPorts']);
    Route::post('ports/add', ['as' => '/ports/add', 'uses' => 'PortsController@postAddPorts']);

    Route::get('users', ['as' => '/users', 'uses' => 'UsersController@getIndex']);
});
