<?php
/**
 * 这里是前台页面路由
 */

//Route::get('home',function(){
//    return 'home';
//});

Route::group(['prefix'=>'','namespace'=>'Home'],function(){
    //前台首页路由
    Route::any('/','HomeController@index');
    Route::any('home','HomeController@index');
    Route::any('creation','CreationController@index');
    //产品样片
    Route::any('product','ProductController@index');
    //在线作品
    Route::any('creation','CreationController@index');
    //供应单位
    Route::any('supply','SupplyController@index');
    //需求信息
    Route::any('demand','DemandController@index');
    //娱乐频道
    Route::any('entertain','EntertainController@index');
    //租赁频道
    Route::any('rent/SD/{genre}','RentController@index');
    Route::any('rent','RentController@index');
    //设计频道
    Route::any('design','DesignController@index');
    //关于我们
    Route::any('about','AboutController@index');
//    //创意路由
//    Route::get('idea','IdeaController@index');
//    //话题路由
//    Route::get('talk','TalkController@index');
//    Route::get('talk/{id}','TalkController@show');
    //用户对本站的意见栏
    Route::get('opinion/create/{reply}','OpinionController@create');
    Route::get('opinion/create','OpinionController@create');
    Route::post('opinion/{id}','OpinionController@update');
    Route::get('{status}/opinion','OpinionController@index');
    Route::resource('opinion','OpinionController');
    //创意路由
    Route::resource('idea','IdeaController');
    //话题路由
    Route::resource('talk','TalkController');
});


//Route::group(['prefix'=>'','middleware' =>'MemberAuth','namespace'=>'Home'],function(){
//Route::group(['prefix'=>'','namespace'=>'Home'],function(){
//});