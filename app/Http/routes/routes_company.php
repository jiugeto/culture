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
//        Route::resource('info','InfoController');
            //布局路由
        Route::resource('layout','LayoutController');
            //基本设置路由
        Route::resource('basic','BasicController');
            //添加单页路由
        Route::resource('single','SingleController');
        //公司内容设置路由
        Route::resource('content','ContentController');
            //公司简介路由
        Route::resource('intro','IntroController');
            //新闻路由
        Route::resource('contact','ContactController');
            //联系路由
        Route::resource('contact','ContactController');
            //荣誉路由
        Route::resource('honor','HonorController');
            //团队路由
        Route::resource('team','TeamController');
            //产品路由
        Route::get('product/trash','ProductController@trash');
        Route::get('product/{id}/destroy','ProductController@destroy');
        Route::get('product/{id}/restore','ProductController@restore');
        Route::get('product/{id}/forceDelete','ProductController@forceDelete');
        Route::post('product/{id}','ProductController@update');
        Route::resource('product','ProductController');
            //花絮路由
        Route::get('part/trash','PartController@trash');
        Route::get('part/{id}/destroy','PartController@destroy');
        Route::get('part/{id}/restore','PartController@restore');
        Route::get('part/{id}/forceDelete','PartController@forceDelete');
        Route::post('part/{id}','PartController@update');
        Route::resource('part','PartController');
            //招聘路由
        Route::get('job/create/{id}','JobController@create');
        Route::get('job/{id}/del','JobController@del');
        Route::post('job/{id}','JobController@update');
        Route::resource('job','JobController');
    });
});