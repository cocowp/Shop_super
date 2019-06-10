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

Route::get('/', function () {
    return view('welcome',['website'=>'Laravel']);
});

Route::view('view','welcome',['website'=>'LaravelWP']);

Route::get('hello',function (){
   return 'Hello ,welcome to LaravelAcademy.org';
});


Route::any('moneyoff_acticity','Active_manageController@moneyoff_acticity');
Route::any('discount_coupon','Active_manageController@discount_coupon');
Route::any('full_give','Active_manageController@full_give');
Route::any('alist','AdminController@alist');
Route::any('add','Brand_manageController@add');
Route::any('lists','Brand_manageController@lists');
Route::any('attribute_add','Commodity_manageController@attribute_add');
Route::any('attribute_list','Commodity_manageController@attribute_list');
Route::any('attribute_list_attribute_manage','Commodity_manageController@attribute_list_attribute_manage');
Route::any('attribute_list_attribute_manage_lists','Commodity_manageController@attribute_list_attribute_manage_lists');
Route::any('attribute_list_attribute_manage_add','Commodity_manageController@attribute_list_attribute_manage_add');
Route::any('add','Goodscategory_manageController@add');
Route::any('lists','Goodscategory_manageController@lists');
Route::any('index','IndexController@index');
Route::any('lists','Order_manageController@lists');
Route::any('state','Order_manageController@state');
Route::any('list_compile','Order_manageController@list_compile');
Route::any('list_compile_state_amend','Order_manageController@list_compile_state_amend');
Route::any('list_compile_user_amend','Order_manageController@list_compile_user_amend');
Route::any('list_compile_commodity_amend','Order_manageController@list_compile_commodity_amend');
Route::any('state_add','Order_manageController@state_add');
Route::any('state_list','Order_manageController@state_list');
Route::any('comment_audit','Service_manageController@comment_audit');
Route::any('comment_reply','Service_manageController@comment_reply');
Route::any('opinion_list','Service_manageController@opinion_list');
Route::any('opinion_reply','Service_manageController@opinion_reply');
Route::any('warehouse_add','Store_manageController@warehouse_add');
Route::any('warehouse_list','Store_manageController@warehouse_list');