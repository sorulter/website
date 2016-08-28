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
    return app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('ping');
    return view('welcome');
});

$router->pattern('id', '[0-9]+');
$router->pattern('name', '[0-9A-Za-z]{3,20}');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
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

// Track
Route::get('ad/{name}', ['as' => '/ad', 'uses' => 'TrackerController@ad']);
Route::get('promote/{name}', ['as' => '/promote', 'uses' => 'TrackerController@promote']);
Route::get('i/{name}', ['as' => '/invitation', 'uses' => 'TrackerController@invitation']);

// user group routes...
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user'], function () {
    // With auth middleware.
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);
    });

    Route::group(['middleware' => ['auth', 'activate']], function () {
        // Settings routes...
        Route::get('settings', ['as' => '/settings', 'uses' => 'SettingsController@getIndex']);
        Route::get('settings/pac', ['as' => '/settings/pac', 'uses' => 'SettingsController@getPAC']);
        Route::post('settings/pac', ['as' => '/settings/pac', 'uses' => 'SettingsController@postAddPAC']);
        Route::get('settings/pac/remove/{name}', ['as' => '/settings/pac/remove', 'uses' => 'SettingsController@getRemovePAC']);
        Route::get('settings/pac/global', ['as' => '/settings/pac/global', 'uses' => 'SettingsController@getGlobalPAC']);
        Route::get('settings/pac/auto', ['as' => '/settings/pac/auto', 'uses' => 'SettingsController@getAutoPAC']);

        // Billing routes...
        Route::get('billing', ['as' => '/billing', 'uses' => 'BillingController@getIndex']);
        Route::any('billing/charge', ['as' => '/mall/payment', 'uses' => function () {
            return redirect()->route('user/mall');
        }]);

        // Cellular routes...
        Route::get('cellular', ['as' => '/cellular', 'uses' => 'CellularController@getIndex']);
        Route::get('cellular/config/{net}', ['as' => '/cellular/config', 'uses' => 'CellularController@getConfig'])->where('net', '[a-z3]+');

        // Helps routes...
        Route::get('helps', ['as' => '/helps', 'uses' => 'HelpsController@index']);
        Route::get('helps/{id}', ['as' => '/helps', 'uses' => 'HelpsController@show']);

        Route::get('status', ['as' => '/status', 'uses' => 'HomeController@status']);

        Route::get('logs', ['as' => '/logs', 'uses' => 'LogsController@index']);

        // Mall routes...
        Route::get('mall', ['as' => '/mall', 'uses' => 'MallController@index']);
        Route::post('mall/payment', ['as' => '/mall/payment', 'uses' => 'MallController@payment']);
        Route::get('mall/waitpay/{id}', ['as' => '/mall/waitpay', 'uses' => 'MallController@waitpay']);

        // Invitation
        Route::get('invitation', ['as' => '/invitation', 'uses' => 'InvitationController@index']);

    });

    // Without auth middleware.
    Route::any('billing/result', ['as' => '/billing/result', 'uses' => 'BillingController@result']);
    Route::any('callback/alipay.v2', ['as' => '/callback/alipay.v2', 'uses' => 'CallbackController@alipayV2']);

});

Route::group(['prefix' => env('ADMINNS'), 'middleware' => ['auth', 'admin'], 'namespace' => 'Admin', 'as' => 'admin'], function () {
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@getIndex']);

    Route::get('ports', ['as' => '/ports', 'uses' => 'PortsController@getIndex']);
    Route::get('ports/index/used', ['as' => '/ports/index/used', 'uses' => 'PortsController@getIndexUsed']);
    Route::get('ports/index/empty', ['as' => '/ports/index/empty', 'uses' => 'PortsController@getIndexEmpty']);
    Route::get('ports/add', ['as' => '/ports/add', 'uses' => 'PortsController@getAddPorts']);
    Route::post('ports/add', ['as' => '/ports/add', 'uses' => 'PortsController@postAddPorts']);

    Route::get('users/s/{key}', ['as' => '/users/search', 'uses' => 'UsersController@getSearch'])->where('key', '[0-9A-Za-z]{1,20}');
    Route::get('users/activate/{id}', ['as' => '/users/activate', 'uses' => 'UsersController@getActivate']);
    Route::get('users', ['as' => '/users', 'uses' => 'UsersController@getIndex']);
    Route::get('users/index/combo', ['as' => '/users/index/combo', 'uses' => 'UsersController@getCombo']);
    Route::get('users/index/forever', ['as' => '/users/index/forever', 'uses' => 'UsersController@getForever']);
    Route::get('users/index/bought', ['as' => '/users/index/bought', 'uses' => 'UsersController@getBought']);
    Route::get('users/index/useable', ['as' => '/users/index/useable', 'uses' => 'UsersController@getUseable']);
    Route::get('users/sendmail/{id}', ['as' => '/users/sendmail', 'uses' => 'UsersController@getSendMail']);
    Route::post('users/sendmail/{id}', ['as' => '/users/sendmail', 'uses' => 'UsersController@postSendMail']);
    Route::get('users/gift/{id}', ['as' => '/users/gift', 'uses' => 'UsersController@getGift']);
    Route::post('users/gift/{id}', ['as' => '/users/gift', 'uses' => 'UsersController@postGift']);
    Route::get('users/logs/{id}', ['as' => '/users/logs', 'uses' => 'UsersController@getLogs']);
    Route::get('users/orders/{id}', ['as' => '/users/orders', 'uses' => 'UsersController@getOrders']);

    Route::get('category', ['as' => '/category', 'uses' => 'CategoryController@index']);

    Route::get('articles', ['as' => '/articles', 'uses' => 'ArticlesController@index']);
    Route::get('articles/create', ['as' => '/articles/create', 'uses' => 'ArticlesController@create']);
    Route::post('articles/store', ['as' => '/articles/store', 'uses' => 'ArticlesController@store']);
    Route::get('articles/edit/{id}', ['as' => '/articles/edit', 'uses' => 'ArticlesController@edit']);
    Route::post('articles/update/{id}', ['as' => '/articles/update', 'uses' => 'ArticlesController@update']);

    Route::get('orders', ['as' => '/orders', 'uses' => 'OrdersController@index']);
    Route::get('orders/index/paid', ['as' => '/orders/index/paid', 'uses' => 'OrdersController@paid']);
    Route::get('orders/index/unpaid', ['as' => '/orders/index/unpaid', 'uses' => 'OrdersController@unpaid']);

    Route::get('products', ['as' => '/products', 'uses' => 'ProductsController@index']);
    Route::get('products/trashed', ['as' => '/products/trashed', 'uses' => 'ProductsController@trashed']);
    Route::get('products/create', ['as' => '/products/create', 'uses' => 'ProductsController@create']);
    Route::post('products/store', ['as' => '/products/store', 'uses' => 'ProductsController@store']);
    Route::get('products/edit/{id}', ['as' => '/products/edit', 'uses' => 'ProductsController@edit']);
    Route::post('products/update/{id}', ['as' => '/products/update', 'uses' => 'ProductsController@update']);
    Route::get('products/destroy/{id}', ['as' => '/products/destroy', 'uses' => 'ProductsController@destroy']);
    Route::get('products/restore/{id}', ['as' => '/products/restore', 'uses' => 'ProductsController@restore']);
    Route::get('products/delete/{id}', ['as' => '/products/delete', 'uses' => 'ProductsController@delete']);

    Route::get('tracks', ['as' => '/tracks', 'uses' => 'TracksController@index']);
    Route::get('tracks/today', ['as' => '/tracks/today', 'uses' => 'TracksController@today']);

});

Route::group(['prefix' => 'api/v1', 'as' => 'api', 'namespace' => 'API'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'IndexController@login']);
    Route::get('account', ['as' => 'account', 'uses' => 'IndexController@account']);
});

$api = app('Dingo\Api\Routing\Router');
$api->version(['v1'], function ($api) {
    $api->get('', ['as' => 'ping', 'uses' => function () {
        return 'ok';
    }]);
});
