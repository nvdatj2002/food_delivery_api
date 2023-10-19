<?php
use Illuminate\Support\Facades\Route;
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
$router->get('/api/store','StoreController@index');
$router->get('/api/store/{id}','StoreController@show');
$router->post('/api/store/create','StoreController@store');
$router->put('/api/store/update/{id}','StoreController@update');
$router->delete('/api/store/delete/{id}','StoreController@delete');


// customer
$router->get('/api/customer','CustomerController@index');
$router->get('/api/customer/{id}','CustomerController@show');
$router->post('/api/customer/create','CustomerController@store');
$router->put('/api/customer/update/{id}','CustomerController@update');
$router->get('/api/customer/delete/{id}','CustomerController@delete');

// customer
$router->get('/api/shiper','ShiperController@index');
$router->get('/api/shiper/{id}','ShiperController@show');
$router->post('/api/shiper/create','ShiperController@store');
$router->put('/api/shiper/update/{id}','ShiperController@update');
$router->get('/api/shiper/delete/{id}','ShiperController@destroy');

// product
$router->get('/api/product','ProductController@index');
$router->get('/api/product/{id}','ProductController@show');
$router->post('/api/product/create','ProductController@store');
$router->put('/api/product/update/{id}','ProductController@update');
$router->get('/api/product/delete/{id}','ProductController@delete');

$router->get('/api/order','OrderController@index');
$router->get('/api/order/{id}','OrderController@show');
$router->post('/api/order/create','OrderController@store');
$router->put('/api/order/update/{id}','OrderController@update');
$router->delete('/api/order/delete/{id}','OrderController@delete');


$router->get('/api/caculate','OrderController@caculate');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Route::group(['middleware' => 'auth'],function(){
//     Route::post('/store-token', [NotificationSendController::class, 'updateDeviceToken'])->name('store.token');
//     Route::post('/send-web-notification', [NotificationSendController::class, 'sendNotification'])->name('send.web-notification');
// });