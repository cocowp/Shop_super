<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'base'], function () {
    Route::get('/', function () {
        dd('This is the Base module index page. Build something great!');
    });

    Route::get('/index','IndexController@index');

    Route::get('/welcome',function (){
        return view('base::index.welcome');
    });
    //登录
    Route::get('/login','LoginController@login');
    Route::post('/login_do','LoginController@login_do');
});
