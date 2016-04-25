<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'company','namespace'=>'Company'], function(){
    //企业后台展示
        //首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
        //产品路由
    Route::resource('product','ProductController');
    //企业后台控制
    Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){
        Route::get('/','HomeController@index');
        Route::get('/home','HomeController@index');
    });
});