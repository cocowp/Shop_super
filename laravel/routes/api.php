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

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

<<<<<<< HEAD
Route::group([
    'prefix' => 'order'
], function ($router) {

    Route::get('{id}', 'OrderController@list');
});

=======
    Route::get('user', 'ApiController@getAuthUser');

    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::post('products', 'ProductController@store');
    Route::put('products/{id}', 'ProductController@update');
    Route::delete('products/{id}', 'ProductController@destroy');
});
>>>>>>> 2ea047728b55eabc1e1eb8c71ca2a72109afdb9c
