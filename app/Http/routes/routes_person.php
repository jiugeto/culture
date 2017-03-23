<?php
/**
 * 这里是会员路由
 */

//Route::get('member',function(){
//    return 'member';
//});

Route::group(['prefix'=>'person','middleware' =>'MemberAuth','namespace'=>'Person'], function(){
    Route::get('/','HomeController@index');
    Route::get('s','HomeController@index');         //s代表片源检索
    Route::get('s/{from}','HomeController@index');
    //个人空间
    Route::get('space/s/{g_type}/{p_type}/{d_type}','SpaceController@index');         //s代表检索
    Route::resource('space','SpaceController');
    //用户资料
    Route::get('user/gethead','UserController@getHead');
    Route::post('user/sethead','UserController@setHead');
    Route::get('user/getpwd','UserController@getPwd');
    Route::post('user/pwd/{id}','UserController@setPwd');
    Route::get('user','UserController@index');
    Route::post('user/{id}','UserController@update');
    Route::resource('user','UserController');
    //视频列表
    Route::get('video/pre/{id}','VideoController@pre');
    Route::resource('video','VideoController');
    //产品作品管理
    Route::resource('product','ProductController');
    //好友留言
    Route::get('message/send/{id}','MessageController@setSend');
    Route::post('message/{id}','MessageController@update');
    Route::get('message/m/{menu}','MessageController@index');
    Route::resource('message','MessageController');
    //设计管理
    Route::resource('design','DesignController');
    //好友管理
    Route::post('frield/apply','FrieldController@getApply');        //申请好友
    Route::get('frield/pass/{id}','FrieldController@getPass');      //通过
    Route::post('frield/refuse','FrieldController@getRefuse');      //拒绝
    Route::get('frield/m/{menu}','FrieldController@index');
    Route::get('frield/new','FrieldController@newFrields');
    Route::get('frield/{m}/{id}','FrieldController@show');
    Route::resource('frield','FrieldController');
    //个人后台皮肤管理
    Route::get('skin/pic/{pic_id}','SkinController@setTopBg');
    Route::resource('skin','SkinController');
    //个人签到管理
    Route::get('sign/add/{day}','SignController@add');
    Route::get('sign/{date}','SignController@index');
    Route::resource('sign','SignController');
});