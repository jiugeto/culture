<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'member','namespace'=>'Member'], function(){
    //账户首页
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
    //会员认证
        //个人需求认证
        //个人设计师认证
        //企业需求认证
        //制作企业认证
        //娱乐公司(文化传媒)认证
        //租赁公司认证
    //在线视频制作
    Route::resource('product','ProductController');
    //个人供求
        //个人需求
    Route::post('persondemand/{id}','PersonDemandController@update');
    Route::get('persondemand/{id}/destroy','PersonDemandController@destroy');
    Route::get('persondemand/{id}/restore','PersonDemandController@restore');
    Route::get('persondemand/{id}/forceDelete','PersonDemandController@forceDelete');
    Route::get('persondemand/trash','PersonDemandController@trash');
    Route::resource('persondemand','PersonDemandController');
        //作品供应
    Route::post('works/{id}','WorksController@update');
    Route::get('works/trash','WorksController@trash');
    Route::resource('works','WorksController');
        //作品类型
    Route::post('category/{id}','CategoryController@update');
    Route::get('category/trash','CategoryController@trash');
    Route::get('category/{id}/destroy','CategoryController@destroy');
    Route::get('category/{id}/restore','CategoryController@restore');
    Route::get('category/{id}/forceDelete','CategoryController@forceDelete');
    Route::resource('category','CategoryController');
    //企业供求
        //企业需求
    Route::resource('companydemand','CompanyDemandController');
        //企业产品
    Route::resource('companyproduct','CompanyProductController');
        //租赁供求之需求
    Route::resource('rentD','RentDController');
        //租赁供求之供应
    Route::resource('rentS','RentSController');
        //娱乐供求之需求
    Route::resource('entertainD','EntertainDController');
        //娱乐供求之需求
    Route::resource('entertainS','EntertainSController');
});