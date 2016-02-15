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
});