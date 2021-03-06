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



    Route::get('/login','LoginController@login');
    Route::post('/login_do','LoginController@login_do');

    Route::get('/menu_list','MenuController@index');
    Route::get('/menu_delOne','MenuController@delOne');
    Route::get('/menu_edit','MenuController@menu_edit');
    Route::post('/menu_editdo','MenuController@menu_editdo');
    Route::post('/add_pmenu','MenuController@add_pmenu');
    Route::get('/menu_add','MenuController@menu_add');
    Route::post('/menu_adddo','MenuController@menu_adddo');
    Route::get('/admin_list','Member_manageController@lists');
    Route::get('/admin_editing','Member_manageController@editing');
    Route::post('/admin_update','Member_manageController@updateinfo');
    Route::get('/admin_delete','Member_manageController@deleteinfo');
    Route::post('/admin_adddo','Member_manageController@adddo');


    Route::get('delete','Store_manageController@delete');
    Route::get('warehouse_list','Store_manageController@warehouse_list');
    Route::get('admin_lists','Member_manageController@admin_lists');
    Route::get('admin_cates','Member_manageController@admin_cate');
    Route::get('admin_roles','Member_manageController@admin_role');
    Route::get('admin_rules','Member_manageController@admin_rule');
    Route::get('admin_cate_do','Member_manageController@admin_cate_do');

    Route::get('/admin_add',function (){
       return view('base::memberage.add');
    });
    Route::get('/catlist','Goodscategory_manageController@lists');
    Route::get('/search_child','Goodscategory_manageController@search_child');
    Route::get('/cat_delete','Goodscategory_manageController@cat_delete');
    Route::get('/catadd','Goodscategory_manageController@add');
    Route::get('/getchild','Goodscategory_manageController@getchild');
    Route::post('/addchild','Goodscategory_manageController@addchild');
    
	Route::any('/act_list','Active_manageController@lists')->name('active/list');
	Route::any('/act_create','Active_manageController@create')->name('active/create');
    Route::any('/act_del','Active_manageController@del')->name('active/del');
    Route::any('/act_edit_status','Active_manageController@edit_status')->name('active/edit_status');
    Route::any('/act_edit','Active_manageController@edit')->name('active/edit');



	Route::any('add','Brand_manageController@add');
	Route::any('lists','Brand_manageController@lists');


	Route::any('attribute_add','Commodity_manageController@commodity_add');
	Route::get('add_sku','Commodity_manageController@add_sku');
	Route::any('attribute_list','Commodity_manageController@commodity_list');
    Route::get('commodity_delete','Commodity_manageController@commodity_delete');
	Route::any('attribute_list_attribute_manage','Commodity_manageController@attribute_list_attribute_manage');
	Route::any('attribute_list_attribute_manage_lists','Commodity_manageController@attribute_list_attribute_manage_lists');
	Route::any('attribute_list_attribute_manage_add','Commodity_manageController@attribute_list_attribute_manage_add');
    //上边是有关商品的
    //下边是有关属性的
    Route::any('attr_list','AttrController@index');
    Route::any('attr_add','AttrController@attr_add');
    Route::any('attr_add_do','AttrController@attr_add_do');
    Route::any('attrvalue_add','AttrController@attrvalue_add');
    Route::any('attrvalue_add_do','AttrController@attrvalue_add_do');
    Route::any('attrvalue_list','AttrController@attrvalue_list');
    Route::any('attrvalue_del','AttrController@attrvalue_del');
    Route::any('attrvalue_edit','AttrController@attrvalue_edit');
    Route::any('attrvalue_edit_do','AttrController@attrvalue_edit_do');
    Route::any('add_attr','AttrController@add_attr');


	Route::any('index','IndexController@index');


	Route::any('order_lists','Order_manageController@lists')->name('order/list');
	Route::any('order_create','Order_manageController@create')->name('order/create');
	Route::any('order_edit','Order_manageController@edit')->name('order/edit');
	Route::any('order_edit_status','Order_manageController@editOrderStatus')->name('order/editOrderStatus');
	Route::any('order_del','Order_manageController@del')->name('order/del');

	Route::any('state','Order_manageController@state');
	Route::any('list_compile','Order_manageController@list_compile');
	Route::any('list_compile_state_amend','Order_manageController@list_compile_state_amend');
	Route::any('list_compile_user_amend','Order_manageController@list_compile_user_amend');
	Route::any('list_compile_commodity_amend','Order_manageController@list_compile_commodity_amend');
	Route::any('state_add','Order_manageController@state_add');
	Route::any('state_list','Order_manageController@state_list');

    //客服中心
	Route::any('comment_audit','Service_manageController@comment_audit');//商品评论审核
	Route::any('comment_reply','Service_manageController@comment_reply');//评论回复
	Route::any('opinion_list','Service_manageController@opinion_list');//用户意见反馈列表
	Route::any('opinion_reply','Service_manageController@opinion_reply');//用户意见回复
    Route::any('reply','Service_manageController@reply');
    Route::any('replyy','Service_manageController@replyy');
    Route::any('reply_do','Service_manageController@reply_do');

	Route::any('warehouse_add','Store_manageController@warehouse_add');
	Route::any('warehouse_list','Store_manageController@warehouse_list');

    Route::any('admin_cate','Member_manageController@admin_cate');
    Route::any('admin_list','Member_manageController@admin_list');
    Route::any('admin_role','Member_manageController@admin_role');
    Route::any('admin_rule','Member_manageController@admin_rule');
    Route::any('admin_add','Member_manageController@admin_add');//管理员添加


});