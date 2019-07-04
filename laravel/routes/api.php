<?php

use Illuminate\Http\Request;

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

//Route::resource('orders', 'OrderController', ['except' => ['create', 'edit']]);

Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

//获取商品信息
Route::group([
    'prefix' => 'goods'
], function ($router) {

    Route::get('/hot', 'Api\GoodsController@hot');
    Route::get('/fruit', 'Api\GoodsController@fruit');
    Route::get('/product/{id}', 'Api\GoodsController@product');
});


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::group([
        'prefix' => 'order'
    ], function ($router) {
        Route::get('/list', 'Api\OrderController@list');
        Route::post('/create', 'Api\OrderController@create');
        Route::get('', 'Api\OrderController@show');
        Route::post('/edit_order_status','Api\OrderController@edit_order_status');
        Route::post('/del_order', 'Api\OrderController@destroy');
    });
    Route::group([
        'prefix' => 'car'
    ], function ($router) {
        Route::get('/list', 'Api\CarController@list');

    });









    Route::get('user', 'ApiController@getAuthUser');

    Route::post('User_register','RegisterController@register'); //实例接口

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');
});
