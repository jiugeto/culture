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
        //作品供应
    //企业供求
        //个人需求
        //作品供应
});