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

$router->get('login', 'Auth\AuthCtrl@authentication');
$router->get('logout/{id}', 'Auth\AuthCtrl@logout');
$router->post('register', 'Auth\UserRegistrationCtrl@register');


$router->group(['middleware' => ['cors', 'auth'], 'prefix' => 'api/'], function($router)
{
    $router->post('createuser', 'UserController@get_user');
    $router->get('product_category', 'ProductCategoryCtrl@index');
    $router->post('product_category', ['middleware' => 'role:super-admin', 'uses' =>'ProductCategoryCtrl@store']);
    // $router->post('product_category', 'ProductCategoryCtrl@store');
    $router->put('product_category', ['middleware' => 'can:create-product-category', 'uses' =>'ProductCategoryCtrl@store']);
    $router->put('todo/{id}', 'TodoController@update');
    $router->delete('todo/{id}', 'TodoController@destroy');
});