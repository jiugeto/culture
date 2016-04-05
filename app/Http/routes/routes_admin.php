<?php
/**
 * 系统后台权限
 */
Route::group(['prefix' => 'admin','namespace'=>'Admin'], function(){
    Route::get('login', 'LoginController@login');
    Route::post('login', 'LoginController@dologin');
    Route::get('logout', 'LoginController@dologout');
});

/**
 * 这里是系统后台路由
 */
Route::group(['prefix'=>'admin','middleware' => 'AdminAuth','namespace'=>'Admin'],function(){
//Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //系统后台首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
        //图片管理
    Route::post('pic/{id}','PicController@update');
    Route::get('pic/create/{id}','PicController@create');
    Route::resource('pic','PicController');
        //类型管理
    Route::post('type/{id}','TypeController@update');
    Route::get('type/create/{id}','TypeController@create');
    Route::resource('type','TypeController');
    Route::get('type/tableid/{table_id}','TypeController@index');
    //权限管理
        //管理员路由
    Route::post('admin/{id}','AdminController@update');
//    Route::get('admin/{id}/destroy','AdminController@destroy');
    Route::get('admin/{id}/forceDelete','AdminController@forceDelete');
    Route::resource('admin','AdminController');
        //角色路由
    Route::post('role/{id}','RoleController@update');
    Route::get('role/{id}/forceDelete','RoleController@forceDelete');
    Route::resource('role','RoleController');
        //操作路由
    Route::get('action/create/{pid}','ActionController@create');
    Route::post('action/{id}','ActionController@update');
    Route::get('action/{id}/forceDelete','ActionController@forceDelete');
    Route::resource('action','ActionController');
        //用户权限分配
    Route::resource('authorization','AuthorizationController');
        //前台功能
    Route::post('function/{id}','FunctionController@update');
    Route::get('function/trash','FunctionController@trash');
    Route::resource('function','FunctionController');
        //前台左侧菜单链接功能
    Route::post('menus/{id}','MenusController@update');
    Route::get('menus/{id}/forceDelete','MenusController@forceDelete');
    Route::get('menus/trash','MenusController@trash');
    Route::get('{type}/menus/trash','MenusController@trash');
    Route::get('{type}/menus','MenusController@index');
    Route::resource('menus','MenusController');
    //供求管理
        //供应路由
        //需求路由
    //内部产品路由
    Route::resource('product','ProductController');
    //产品管理
        //内部产品属性路由
    Route::resource('productattr','ProductAttrController');
        //产品类型路由
    Route::resource('category','CategoryController');
    //租赁路由
    Route::resource('rent','RentController');
    //娱乐路由
    Route::post('entertain/{id}','EntertainController@update');
    Route::resource('entertain','EntertainController');
    //设计路由
    Route::post('design/{id}','DesignController@update');
    Route::get('design/trash','DesignController@trash');
    Route::resource('design','DesignController');
    //消息路由
        //消息管理
    Route::resource('message','MessageController');
        //链接管理
    Route::resource('link','LinkController');
        //心声管理
    Route::resource('voice','VoiceController');
    //广告路由
        //广告管理
    Route::resource('ad','AdController');
        //广告位管理
    Route::get('place/create','AdPlaceController@create');
    Route::resource('place','AdPlaceController');
        //用户意见管理
    Route::post('opinions/{id}','OpinionsController@update');
    Route::get('opinions/{id}/destroy','OpinionsController@destroy');
    Route::get('opinions/{id}/restore','OpinionsController@restore');
    Route::get('opinions/{id}/forceDelete','OpinionsController@forceDelete');
    Route::get('opinions/trash','OpinionsController@trash');
    Route::get('opinions/{isshow}/trash','OpinionsController@trash');
    Route::get('{isshow}/opinions','OpinionsController@index');
    Route::resource('opinions','OpinionsController');
});