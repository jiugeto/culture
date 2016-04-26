<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'company','namespace'=>'Company'], function(){
    //企业页面展示
        //首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
        //产品路由
    Route::resource('product','ProductController');
        //花絮路由
    Route::resource('brief','BriefController');
        //服务路由
    Route::resource('firm','FirmController');
        //团队路由
    Route::resource('team','TeamController');
        //招聘路由
    Route::resource('recruit','RecruitController');
        //联系方式路由
    Route::resource('contact','ContactController');
    //企业后台控制
    Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){
        //后台首页路由
        Route::get('/','HomeController@index');
        Route::get('home','HomeController@index');
        //权限路由
        Route::resource('auth','AuthController');
        //公司信息路由
        Route::resource('info','InfoController');
            //布局路由
        Route::resource('layout','LayoutController');
            //基本设置路由
        Route::resource('basic','BasicController');
            //添加单页路由
        Route::resource('single','SingleController');
        //公司内容设置路由
        Route::resource('content','ContentController');
    });
});