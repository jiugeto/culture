<?php

/**
 * 在线创作路由
 */
Route::group(['prefix'=>'online','middleware' =>'MemberAuth','namespace'=>'Online'],function(){
//Route::group(['prefix'=>'online','namespace'=>'Online'],function(){
    //主窗口
    Route::get('/','HomeController@index');
    Route::get('restart','HomeController@index');
    Route::get('home','HomeController@index');
    //单帧编辑路由
    Route::resource('{productid}/frame','FrameController');
    Route::get('{productid}/frame/style/{attrid}','FrameController@style');
    Route::get('{productid}/frame/layer/{layerid}','FrameController@layer');
});

//用户参数路由
Route::group(['prefix'=>'','middleware' =>'MemberAuth','namespace'=>'Common'],function() {
    Route::get('/footSwitch/set/{footSwitch}', 'UserParamsController@setFootSwitch');
});