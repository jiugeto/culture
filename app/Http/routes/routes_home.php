<?php
/**
 * 这里是前台页面路由
 */

//Route::get('home',function(){
//    return 'home';
//});

Route::group(['namespace'=>'Home'],function(){
    //前台首页路由
    Route::any('/','HomeController@index');
    Route::any('home','HomeController@index');
    Route::any('creation','CreationController@index');
    //产品样片
    Route::any('product','ProductController@index');
    //在线作品
    Route::any('creation','CreationController@index');
    //供应单位
    Route::any('supply','SupplyController@index');
});