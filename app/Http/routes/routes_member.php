<?php

//Route::get('member',function(){
//    return 'member';
//});

/**
 * 这里是注册、登陆路由
 */
Route::group(['prefix'=>'login'], function(){
    Route::resource('/','LoginController');
    Route::resource('dologin','LoginController@dologin');
    Route::resource('dologout','LoginController@dologout');
});
Route::group(['prefix'=>'regist'], function(){
    Route::resource('/','RegisterController');
    Route::resource('doregist','RegisterController@doregist');
    Route::get('success','RegisterController@success');
    Route::get('fail','RegisterController@fail');
});


/**
 * 这里是会员路由
 */
Route::group(['prefix'=>'member','middleware' =>'MemberAuth','namespace'=>'Member'], function(){
//Route::group(['prefix'=>'member','namespace'=>'Member'], function(){
    //账户首页
    Route::get('/','HomeController@index');
    Route::get('/home','HomeController@index');
    //会员账户
        //会员认证
    Route::get('setting','SettingController@show');
    Route::get('setting/{id}/auth','SettingController@auth');
    Route::post('setting/{id}','SettingController@update');
    Route::get('setting/pwd/{id}','SettingController@pwd');
    Route::post('setting/updatepwd/{id}','SettingController@updatepwd');
    Route::get('setting/info/{id}','SettingController@info');
    Route::post('setting/updateinfo/{id}','SettingController@updateinfo');
//    Route::resource('setting','SettingController');
    //个人设计师、制作企业、经纪公司、租赁公司认证
    //在线视频制作
    Route::post('product/{id}','ProductController@update');
    Route::resource('product','ProductController');
    //片源定制
    Route::get('proCus/{id}/cus','ProductCusController@cuslist');
    Route::resource('proCus','ProductCusController');
    //在线定制
    Route::post('provideo/{id}','ProductVideoController@update');
//    Route::get('provideo/pre/{id}','ProductVideoController@pre');   //预览视频
    Route::get('provideo/trash','ProductVideoController@trash');
    Route::resource('provideo','ProductVideoController');
    //供求管理
        //视频管理
    Route::post('goods/{id}','GoodsController@update');
    Route::get('goods/trash','GoodsController@trash');
    Route::get('goods/{id}/destroy','GoodsController@destroy');
    Route::get('goods/{id}/restore','GoodsController@restore');
    Route::get('goods/{id}/forceDelete','GoodsController@forceDelete');
    Route::resource('goods','GoodsController');
        //租赁管理
    Route::post('rent/{id}','RentController@update');
    Route::get('rent/{id}/destroy','RentController@destroy');
    Route::get('rent/{id}/restore','RentController@restore');
    Route::get('rent/{id}/forceDelete','RentController@forceDelete');
    Route::get('rent/trash','RentController@trash');
    Route::get('rent/s/{genre}/{type}','RentController@index');
    Route::resource('rent','RentController');
        //娱乐管理
    Route::post('entertain/{id}','EntertainController@update');
    Route::get('entertain/{id}/destroy','EntertainController@destroy');
    Route::get('entertain/{id}/restore','EntertainController@restore');
    Route::get('entertain/{id}/forceDelete','EntertainController@forceDelete');
    Route::get('entertain/trash','EntertainController@trash');
    Route::resource('entertain','EntertainController');
        //娱乐员工管理
    Route::post('staff/{id}','StaffController@update');
    Route::get('staff/{id}/destroy','StaffController@destroy');
    Route::get('staff/{id}/restore','StaffController@restore');
    Route::get('staff/{id}/forceDelete','StaffController@forceDelete');
    Route::get('staff/trash','StaffController@trash');
    Route::resource('staff','StaffController');
        //艺人管理
    Route::post('actor/{id}','ActorController@update');
    Route::get('actor/{id}/destroy','ActorController@destroy');
    Route::get('actor/{id}/restore','ActorController@restore');
    Route::get('actor/{id}/forceDelete','ActorController@forceDelete');
    Route::get('actor/trash','ActorController@trash');
    Route::resource('actor','ActorController');
        //创意管理
    Route::post('idea/{id}','IdeaController@update');
    Route::get('idea/{id}/destroy','IdeaController@destroy');
    Route::get('idea/{id}/restore','IdeaController@restore');
    Route::get('idea/{id}/forceDelete','IdeaController@forceDelete');
    Route::get('idea/trash','IdeaController@trash');
    Route::get('idea/user/{id}','IdeaController@ideaShow');
    Route::get('idea/user/{id}/{uid}','IdeaController@setIdeaShow');
    Route::resource('idea','IdeaController');
        //分镜管理
    Route::get('storyboard/trash','StoryBoardController@trash');
    Route::get('storyboard/{id}/destroy','StoryBoardController@destroy');
    Route::get('storyboard/{id}/restore','StoryBoardController@restore');
    Route::get('storyboard/{id}/forceDelete','StoryBoardController@forceDelete');
    Route::post('storyboard/{id}','StoryBoardController@update');
    Route::resource('storyboard','StoryBoardController');
        //设计管理
    Route::post('design/{id}','DesignController@update');
    Route::get('design/trash','DesignController@trash');
    Route::get('design/{id}/destroy','DesignController@destroy');
    Route::resource('design','DesignController');
    //基本管理
        //图片管理
    Route::post('pic/{id}','PicController@update');
    Route::get('pic/{id}/destroy','PicController@destroy');
    Route::get('pic/{id}/restore','PicController@restore');
    Route::get('pic/{id}/forceDelete','PicController@forceDelete');
    Route::get('pic/trash','PicController@trash');
    Route::resource('pic','PicController');
        //视频管理
    Route::post('video/{id}','VideoController@update');
    Route::get('video/{id}/destroy','VideoController@destroy');
    Route::get('video/{id}/restore','VideoController@restore');
    Route::get('video/{id}/forceDelete','VideoController@forceDelete');
    Route::get('video/trash','VideoController@trash');
    Route::get('video/uploadWay','VideoController@uploadWay');
    Route::get('video/leplay/{leplay}','VideoController@setLeplay');
    Route::resource('video','VideoController');
        //消息管理
    Route::get('message/list/{list}','MessageController@index');        //list==1收件箱，2发件箱
    Route::resource('message','MessageController');
    Route::get('message/chat/{chat_uid}','MessageController@chatList');
    Route::post('message/addmsg','MessageController@insertMsg');
    Route::post('message/getmsg','MessageController@getLastMsg');
    //订单路由
        //订单流程
    Route::post('order/pay','OrderController@setPay');
    Route::get('order/paystatus/{id}','OrderController@setOrderStatus');
    Route::get('order/getPay/{id}/{cate}/{status}','OrderController@setPayStatus');
    Route::get('order/{id}/{status}','OrderController@setStatus');
    Route::post('order/tosure','OrderController@tosure');
    Route::post('order/create','OrderController@create');
    Route::resource('order','OrderController');
        //售后（样片修改）路由
    Route::resource('orderfirm','OrderFirmController');
        //在线创作路由
    Route::get('orderpro/comment/{id}/{comment}/{backGold}','OrderProductController@setComment');
    Route::get('orderpro/{id}/destroy','OrderProductController@destroy');
    Route::resource('orderpro','OrderProductController');
    //话题管理
    Route::resource('talk','TalkController');
    Route::get('talk/i/{index}','TalkController@index');      //i代表index
    //钱袋管理
    Route::get('wallet/gettip/{type}/{tip}','WalletController@setTip');     //获取红包
    Route::get('gold','WalletController@goldList');       //金币列表
    Route::get('tip','WalletController@tipList');        //红包列表
    Route::get('wallet/tiptoweal/{tip}','WalletController@setWealByTip');    //红包兑换
    Route::get('wallet/goldtoweal/{gold}','WalletController@setWealByGold');    //金币兑换
    Route::get('wallet/signtoweal/{sign}','WalletController@setWealBySign');    //兑换签到
    Route::resource('wallet','WalletController');
});