<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','IndexController@index');

Route::view('view','welcome',['website'=>'LaravelWP']);

Route::get('hello',function (){
   return 'Hello ,welcome to LaravelAcademy.org';
});
//登录
Route::any('/login','LoginController@login')->name('login');
Route::get('/index','IndexController@index');
Route::get('/buycar','BuycarController@index');
Route::get('/regist','RegistController@index')->name('regist');
Route::get('/user','IndexController@userinfo')->name('user');

Route::get('/product','IndexController@product')->name('product');
Route::get('/user_order', 'OrdersController@show')->name('uorder');

