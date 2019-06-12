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

    Route::get('/admin_list','Member_manageController@lists');
    Route::get('/admin_editing','Member_manageController@editing');
    Route::post('/admin_update','Member_manageController@updateinfo');
    Route::get('/admin_delete','Member_manageController@deleteinfo');
    Route::post('/admin_adddo','Member_manageController@adddo');
    Route::get('/admin_add',function (){
       return view('base::memberage.add');
    });

    Route::get('/catlist','Goodscategory_manageController@lists');
    Route::get('/search_child','Goodscategory_manageController@search_child');
    Route::get('/cat_delete','Goodscategory_manageController@cat_delete');
});
