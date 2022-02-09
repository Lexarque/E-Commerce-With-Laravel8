<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customersController;
use App\Http\Controllers\productController;
use App\Http\Controllers\detail_ordersController;
use App\Http\Controllers\ordersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::get('/getAuthUser', 'UserController@getAuthenticatedUser');


Route::group(['middleware' => ['jwt.verify']], function()
{
    Route::group(['middleware' => ['api.superadmin']], function(){
        Route::post('/customers', 'customersController@store');
        Route::put('/customers/{id_customers}', 'customersController@update');
        Route::delete('/customers/{id_customers}', 'customersController@destroy');

        Route::post('/product', 'productController@store');
        Route::put('/product/{id_product}', 'productController@update');
        Route::delete('/product/{id_product}', 'productController@destroy');

        Route::post('/orders', 'ordersController@store');
        Route::put('orders/{id_orders}', 'ordersController@update');
        Route::delete('/product/{id_orders}', 'ordersController@destroy');

        Route::post('/detail_orders', 'detail_ordersController@store');
        Route::put('/detail_orders/{id_detail_orders}', 'detail_ordersController@update');
        Route::delete('/detail_orders/{id_detail_orders}', 'detail_ordersController@destroy');
    });

    Route::group(['middleware' => ['api.admin']], function(){
        Route::post('/customers', 'customersController@store');
        Route::put('/customers/{id_customers}', 'customersController@update');

        Route::post('/product', 'productController@store');
        Route::put('/product/{id_product}', 'productController@update');
    
        Route::post('/orders', 'ordersController@store');
        Route::put('orders/{id_orders}', 'ordersController@update');
        
        Route::post('/detail_orders', 'detail_ordersController@store');
        Route::put('/detail_orders/{id_detail_orders}', 'detail_ordersController@update');
    });

    Route::get('/customers', 'customersController@show');
    Route::get('/customers/{id_customers}', 'customersController@detail');

    Route::get('/product', 'productController@show');
    Route::get('/product/{id_product}', 'productController@detail');

    Route::get('/orders', 'ordersController@show');
    Route::get('/orders/{id_orders}', 'ordersController@detail');

    Route::get('/detail_orders', 'detail_ordersController@show');
    Route::get('/detail_orders/{id_detail_orders}', 'detail_ordersController@detail');

});
