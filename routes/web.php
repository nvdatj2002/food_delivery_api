<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

// store
$router->get('/store','StoreController@index');
$router->get('/store/{id}','StoreController@show');
$router->post('/store/create','StoreController@store');
$router->post('/store/update/{id}','StoreController@update');
$router->get('/store/delete/{id}','StoreController@delete');


// customer
$router->get('/customer','CustomerController@index');
$router->get('/customer/{id}','CustomerController@show');
$router->post('/customer/create','CustomerController@store');
$router->post('/customer/update/{id}','CustomerController@update');
$router->get('/customer/delete/{id}','CustomerController@delete');

//
$router->get('/', function () use ($router) {
    return $router->app->version();
});
