<?php

/**
 * 在线创作路由
 */

//用户自己的创作房间
Route::group(['prefix'=>'online/u','middleware' =>'MemberAuth','namespace'=>'Online'],function(){
    Route::get('product/getpro/{id}','ProductController@getPro');
    Route::get('product/c/{cate}','ProductController@index');
    Route::resource('product','ProductController');
});

//创作效果样片大厅
Route::group(['prefix'=>'online','namespace'=>'Online'],function() {
    //模板大厅
    Route::get('', 'HomeController@index');
    Route::get('c/{cate}', 'HomeController@index');
    //在线预览
    Route::get('pre/{id}', 'HomeController@show');
    //动画模板
    Route::get('p/lay', 'HomeController@lay');
});

//用户参数路由
Route::group(['prefix'=>'','middleware' =>'MemberAuth','namespace'=>'Common'],function() {
    Route::get('footSwitch/set/{footSwitch}', 'UserParamsController@setFootSwitch');
});