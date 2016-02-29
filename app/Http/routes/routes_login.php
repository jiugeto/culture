<?php
/**
 * 这里是注册、登陆路由
 */

Route::group(['prefix'=>'login'], function(){
    Route::resource('/','LoginController');
});

Route::group(['prefix'=>'regist'], function(){
    Route::resource('/','RegisterController');
});