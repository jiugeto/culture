<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'company','middleware' =>'MemberAuth','namespace'=>'Company'], function(){
    //企业页面展示
        //首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
        //关于公司路由
    Route::resource('about','AboutController');
        //产品路由
    Route::resource('product','ProductController');
        //花絮路由
    Route::resource('part','PartController');
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
        Route::resource('cominfo','ComInfoController');
            //布局路由
        Route::resource('layout','LayoutController');
            //基本设置路由
        Route::resource('basic','BasicController');
            //添加单页路由
        Route::resource('single','SingleController');
        //公司内容设置路由
        Route::resource('content','ContentController');
            //关于公司路由
        Route::post('about/{id}','AboutController@update');
        Route::resource('about','AboutController');
//            //公司简介路由
//        Route::post('intro/{id}','IntroController@update');
//        Route::resource('intro','IntroController');
//            //新闻路由
//        Route::get('{type}/info','InfoController@index');
//        Route::get('info/create/{type}','InfoController@create');
//        Route::post('info/{id}','InfoController@update');
//        Route::resource('info','InfoController');
//            //联系路由
//        Route::post('contact/{id}','ContactController@update');
//        Route::resource('contact','ContactController');
//            //服务路由
//        Route::post('firm/{id}','FirmController@update');
//        Route::resource('firm','FirmController');
//            //团队路由
//        Route::post('team/{id}','TeamController@update');
//        Route::resource('team','TeamController');
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
//            //招聘路由
//        Route::get('job/trash','JobController@trash');
//        Route::get('job/{id}/destroy','JobController@destroy');
//        Route::get('job/{id}/restore','JobController@restore');
//        Route::get('job/{id}/forceDelete','JobController@forceDelete');
//        Route::post('job/{id}','JobController@update');
//        Route::resource('job','JobController');
            //图片管理路由
        Route::get('pic/trash','PicController@trash');
        Route::get('pic/{id}/destroy','PicController@destroy');
        Route::get('pic/{id}/restore','PicController@restore');
        Route::get('pic/{id}/forceDelete','PicController@forceDelete');
        Route::post('pic/{id}','PicController@update');
        Route::resource('pic','PicController');
            //视频管理路由
        Route::get('video/trash','VideoController@trash');
        Route::get('video/{id}/destroy','VideoController@destroy');
        Route::get('video/{id}/restore','VideoController@restore');
        Route::get('video/{id}/forceDelete','VideoController@forceDelete');
        Route::post('video/{id}','VideoController@update');
        Route::resource('video','VideoController');
            //宣传编辑
        Route::get('ppt/trash','PptController@trash');
        Route::get('ppt/{id}/destroy','PptController@destroy');
        Route::get('ppt/{id}/restore','PptController@restore');
        Route::get('ppt/{id}/forceDelete','PptController@forceDelete');
        Route::post('ppt/{id}','PptController@update');
        Route::resource('ppt','PptController');
    });
});