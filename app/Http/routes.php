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
Route::get('activate/send', ['as' => 'activate/send', 'uses' => 'Auth\ActivationController@getSend']);

// user group routes...
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user'], function () {
    // With auth middleware.
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);

        // Settings routes...
        Route::get('settings', ['as' => '/settings', 'uses' => 'SettingsController@getIndex']);

        // Billing routes...
        Route::get('billing', ['as' => '/billing', 'uses' => 'BillingController@getIndex']);
        Route::get('billing/charge', ['as' => '/billing/charge', 'uses' => 'BillingController@getCharge']);
        Route::post('billing/charge', ['as' => '/billing/charge', 'uses' => 'BillingController@postCharge']);
        Route::get('billing/payment', ['as' => '/billing/payment', 'uses' => 'BillingController@getPayment']);
        Route::get('billing/continue/{orderid}', ['as' => '/billing/continue', 'uses' => 'BillingController@getContinue']);

        // Cellular routes...
        Route::get('cellular', ['as' => '/cellular', 'uses' => 'CellularController@getIndex']);
        Route::get('cellular/config/{net}', ['as' => '/cellular/config', 'uses' => 'CellularController@getConfig'])->where('net', '[a-z3]+');

        // Helps routes...
        Route::get('helps', ['as' => '/helps', 'uses' => 'HelpsController@index']);
        Route::get('helps/{id}', ['as' => '/helps', 'uses' => 'HelpsController@show'])->where('id', '[0-9]+');

        Route::get('status', ['as' => '/status', 'uses' => 'HomeController@status']);

        Route::get('logs', ['as' => '/logs', 'uses' => 'LogsController@index']);

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

    Route::get('users/activate/{id}', ['as' => '/users/activate', 'uses' => 'UsersController@getActivate'])->where('id', '[0-9]+');
    Route::get('users', ['as' => '/users', 'uses' => 'UsersController@getIndex']);
    Route::get('users/sendmail/{id}', ['as' => '/users/sendmail', 'uses' => 'UsersController@getSendMail'])->where('id', '[0-9]+');
    Route::post('users/sendmail/{id}', ['as' => '/users/sendmail', 'uses' => 'UsersController@postSendMail'])->where('id', '[0-9]+');
    Route::get('users/gift/{id}', ['as' => '/users/gift', 'uses' => 'UsersController@getGift'])->where('id', '[0-9]+');
    Route::post('users/gift/{id}', ['as' => '/users/gift', 'uses' => 'UsersController@postGift'])->where('id', '[0-9]+');

    Route::get('category', ['as' => '/category', 'uses' => 'CategoryController@index']);

    Route::get('articles', ['as' => '/articles', 'uses' => 'ArticlesController@index']);
    Route::get('articles/create', ['as' => '/articles/create', 'uses' => 'ArticlesController@create']);
    Route::post('articles/store', ['as' => '/articles/store', 'uses' => 'ArticlesController@store']);
    Route::get('articles/edit/{id}', ['as' => '/articles/edit', 'uses' => 'ArticlesController@edit'])->where('id', '[0-9]+');
    Route::post('articles/update/{id}', ['as' => '/articles/update', 'uses' => 'ArticlesController@update'])->where('id', '[0-9]+');
});

Route::group(['prefix' => 'api/v1', 'as' => 'api', 'namespace' => 'API'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'IndexController@login']);
    Route::get('account', ['as' => 'account', 'uses' => 'IndexController@account']);
});
