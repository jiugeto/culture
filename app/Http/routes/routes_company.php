<?php
/**
 * 这里是公司路由
 */

//企业页面展示
Route::group(['prefix'=>'c/{cid}','namespace'=>'Company'], function(){
    //首页路由
    Route::get('/','HomeController@index');
    //关于公司路由
    Route::get('about','AboutController@index');
    Route::get('about/{type}','AboutController@index');
        //新闻资讯详情
    Route::get('news/{id}','AboutController@news');
    //产品路由
    Route::get('product','ProductController@index');
    Route::get('product/{cate}','ProductController@index');
        //花絮路由
    Route::get('part','ProductController@part');
    Route::get('part/{cate}','ProductController@part');
//        //产品、花絮详情
//    Route::get('goods/{id}','ProductController@show');
        //视频预览
    Route::get('video/{id}/{videoid}','ProductController@video');
    //服务路由
    Route::get('firm','FirmController@index');
    //团队路由
    Route::get('team','TeamController@index');
    //招聘路由
    Route::get('recruit','RecruitController@index');
    //联系方式路由
    Route::get('contact','ContactController@index');
    //合作伙伴路由
    Route::get('parterner','HomeController@parterner');
    Route::get('parterner/{id}','HomeController@partShow');
    //访问日志路由
    Route::post('visitlog/set','VisitlogController@setVisit');
});


Route::group(['prefix'=>'company','middleware' =>'MemberAuth','namespace'=>'Company'], function(){
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
        Route::get('layout/module/isshow/{id}/{isshow}','LayoutController@isshow');     //公司页面模块显示设置
        Route::get('layout/module/sort/{id}/{sort}','LayoutController@sort');       //公司页面模块排序设置
        Route::get('layout/h/show/{key}/{switch}','LayoutController@layoutHomeSwitch');       //公司首页信息显示开关
        Route::get('layout/skin/{skin}','LayoutController@setSkin');       //公司页面皮肤更换
        Route::get('layout/m/{m}','LayoutController@index');       //m代表标签选择
        Route::resource('layout','LayoutController');
            //基本设置路由
        Route::post('basic/{id}','BasicController@update');
        Route::resource('basic','BasicController');
            //其他页面（单页）路由
        Route::post('single/{id}','SingleController@update');
        Route::resource('single','SingleController');
            //其他模块路由
        Route::post('singlemodule/{id}','SingleModuleController@update');
        Route::resource('singlemodule','SingleModuleController');
        //公司内容设置路由
        Route::resource('content','ContentController');
            //关于公司路由：公司简介、公司历程、公司新闻、行业资讯、
        Route::post('about/{id}','AboutController@update');
        Route::get('about/t/{type}','AboutController@index');
        Route::resource('about','AboutController');
            //产品路由
        Route::get('product/trash','ProductController@trash');
        Route::get('product/{id}/destroy','ProductController@destroy');
        Route::get('product/{id}/restore','ProductController@restore');
        Route::get('product/{id}/forceDelete','ProductController@forceDelete');
        Route::post('product/{id}','ProductController@update');
        Route::get('product/cate/{cate}','ProductController@index');
        Route::resource('product','ProductController');
            //团队路由
        Route::post('team/{id}','TeamController@update');
        Route::resource('team','TeamController');
            //招聘路由
        Route::post('job/{id}','JobController@update');
        Route::resource('job','JobController');
            //联系路由
        Route::get('contact/map','ContactController@map');      //地图路由
        Route::get('contact/map/{x}/{y}','ContactController@map');
        Route::post('contact/{id}','ContactController@update');
        Route::resource('contact','ContactController');
            //服务路由
        Route::post('firms/{id}','FirmController@update');
        Route::resource('firms','FirmController');
            //新闻资讯路由
        Route::post('news/{id}','NewsController@update');
        Route::resource('news','NewsController');
            //花絮路由
        Route::get('part/trash','PartController@trash');
        Route::get('part/{id}/destroy','PartController@destroy');
        Route::get('part/{id}/restore','PartController@restore');
        Route::get('part/{id}/forceDelete','PartController@forceDelete');
        Route::post('part/{id}','PartController@update');
        Route::resource('part','PartController');
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
            //链接管理
        Route::post('link/{id}','LinkController@update');
        Route::resource('link','LinkController');
        //访问日志路由
        Route::get('visit','VisitlogController@index');
    });
});