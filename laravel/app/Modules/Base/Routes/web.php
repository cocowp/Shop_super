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

    Route::get('/menu_list','MenuController@index');
    Route::get('/menu_delOne','MenuController@delOne');
    Route::get('/menu_edit','MenuController@menu_edit');
    Route::post('/menu_editdo','MenuController@menu_editdo');
    Route::post('/add_pmenu','MenuController@add_pmenu');
    Route::get('/menu_add','MenuController@menu_add');
    Route::post('/menu_adddo','MenuController@menu_adddo');
});