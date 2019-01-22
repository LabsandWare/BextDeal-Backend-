<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([ 'prefix' => 'api/'], function($router)
{

    $router->post('login', 'Auth\AuthCtrl@authentication');
    $router->get('logout/{id}', 'Auth\AuthCtrl@logout');
    $router->post('register', 'Auth\UserRegistrationCtrl@register');

});

$router->group(['middleware' => ['auth'], 'prefix' => 'api/'], function($router)
{
    $router->post('createuser', 'UserController@get_user');

    $router->get('product_category', 'ProductCategoryCtrl@index');
    $router->post('product_category', ['middleware' => 'role:super-admin', 'uses' =>'ProductCategoryCtrl@store']);
    $router->get('product_category/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCategoryCtrl@show']);
    $router->put('product_category/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCategoryCtrl@update']);
    $router->delete('product_category/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCategoryCtrl@destroy']);

    $router->get('product', 'ProductCtrl@index');
    $router->post('product', ['middleware' => 'role:super-admin', 'uses' =>'ProductCtrl@store']);
    $router->get('product_category/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCtrl@show']);
    $router->put('product/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCtrl@update']);
    $router->delete('product/{id}', ['middleware' => 'role:super-admin', 'uses' =>'ProductCtrl@destroy']);

    $router->get('bid_order', 'BidOrderCtrl@index');
    $router->post('bid_order', ['middleware' => 'role:super-admin', 'uses' =>'BidOrderCtrl@store']);
    $router->get('bid_order/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidOrderCtrl@show']);
    $router->put('bid_order/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidOrderCtrl@update']);
    $router->delete('bid_order/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidOrderCtrl@destroy']);

    $router->get('bid_coin_bag', 'BidCoinBagCtrl@index');
    $router->post('bid_coin_bag', ['middleware' => 'role:super-admin', 'uses' =>'BidCoinBagCtrl@store']);
    $router->get('bid_coin_bag/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidCoinBagCtrl@show']);
    $router->put('bid_coin_bag/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidCoinBagCtrl@update']);
    $router->delete('bid_coin_bag/{id}', ['middleware' => 'role:super-admin', 'uses' =>'BidCoinBagCtrl@destroy']);

    $router->get('bid', 'BidCtrl@index');
    $router->post('bid', ['middleware' => 'role:bidder', 'uses' =>'BidCtrl@store']);
    $router->get('bid/{id}', ['middleware' => 'role:bidder', 'uses' =>'BidCtrl@show']);
    $router->put('bid/{id}', ['middleware' => 'role:bidder', 'uses' =>'BidCtrl@update']);
    $router->delete('bid/{id}', ['middleware' => 'role:bidder', 'uses' =>'BidCtrl@destroy']);

});