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
    Route::resource('auth','AuthController');
        //个人设计师认证
        //企业需求认证
        //制作企业认证
        //娱乐公司(文化传媒)认证
        //租赁公司认证
    //在线视频制作
    Route::resource('product','ProductController');
    //个人供求
        //个人需求
    Route::post('personD/{id}','PersonDController@update');
    Route::get('personD/trash','PersonDController@trash');
    Route::get('personD/{id}/destroy','PersonDController@destroy');
    Route::get('personD/{id}/restore','PersonDController@restore');
    Route::get('personD/{id}/forceDelete','PersonDController@forceDelete');
    Route::resource('personD','PersonDController');
        //作品供应
    Route::post('personS/{id}','PersonSController@update');
    Route::get('personS/trash','PersonSController@trash');
    Route::get('personS/{id}/destroy','PersonSController@destroy');
    Route::get('personS/{id}/restore','PersonSController@restore');
    Route::get('personS/{id}/forceDelete','PersonSController@forceDelete');
    Route::resource('personS','PersonSController');
        //作品类型
    Route::post('category/{id}','CategoryController@update');
    Route::get('category/trash','CategoryController@trash');
    Route::get('category/{id}/destroy','CategoryController@destroy');
    Route::get('category/{id}/restore','CategoryController@restore');
    Route::get('category/{id}/forceDelete','CategoryController@forceDelete');
    Route::resource('category','CategoryController');
    //企业供求
        //企业需求
    Route::resource('companyD','CompanyDController');
        //企业产品
    Route::resource('companyS','CompanySController');
        //租赁供求
    Route::get('{genre}/rent','RentController@index');
    Route::resource('rent','RentController');
        //娱乐供求之需求
    Route::resource('entertainD','EntertainDController');
        //娱乐供求之需求
    Route::resource('entertainS','EntertainSController');
});