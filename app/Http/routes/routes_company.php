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
        Route::get('/home','HomeController@index');
        //布局路由
        Route::get('/layout','LayoutController@index');
    });
});