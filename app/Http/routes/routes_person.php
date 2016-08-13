<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'person','middleware' =>'MemberAuth','namespace'=>'Person'], function(){
//Route::group(['prefix'=>'person','namespace'=>'Person'], function(){
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
    //个人资料设置
    Route::resource('setting','SettingController');
});