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
    //在线视频制作
    Route::post('product/{id}','ProductController@update');
    Route::resource('product','ProductController');
//    //片源定制
//    Route::post('goodscus/{id}','GoodsCusController@update');
//    Route::resource('goodscus','GoodsCusController');
//    Route::get('goodscus/cuslist/{id}','GoodsCusController@getCusList');
//    //在线定制
//    Route::post('provideo/{id}','ProductVideoController@update');
//    Route::get('provideo/trash','ProductVideoController@trash');
//    Route::resource('provideo','ProductVideoController');
    //视频管理
    Route::post('video/{id}','VideoController@update');
    Route::post('video/thumb/{id}','VideoController@setThumb');
    Route::post('video/link/{id}','VideoController@setLink');
    Route::resource('video','VideoController');
    //动画管理
    Route::post('part/{id}','PartController@update');
    Route::post('part/thumb/{id}','PartController@setThumb');
    Route::post('part/link/{id}','PartController@setLink');
    Route::resource('part','PartController');
    //租赁管理
    Route::post('rent/{id}','RentController@update');
    Route::get('rent/s/{type}','RentController@index');
    Route::resource('rent','RentController');
    //娱乐管理
    Route::post('entertain/{id}','EntertainController@update');
    Route::resource('entertain','EntertainController');
    //娱乐员工管理
    Route::post('staff/{id}','StaffController@update');
    Route::resource('staff','StaffController');
    //艺人管理
    Route::post('actor/{id}','ActorController@update');
    Route::resource('actor','ActorController');
    //创意管理
    Route::post('idea/{id}','IdeaController@update');
//    Route::get('idea/user/{id}','IdeaController@ideaShow');
//    Route::get('idea/user/{id}/{uid}','IdeaController@setIdeaShow');
    Route::get('idea/s/{genre}','IdeaController@index');
    Route::resource('idea','IdeaController');
    //设计管理
    Route::post('design/{id}','DesignController@update');
    Route::get('design/s/{cate}','DesignController@index');
    Route::resource('design','DesignController');
    //消息管理
    Route::get('message/s/{list}','MessageController@index');
    Route::resource('message','MessageController');
    //订单流程
    Route::post('order/pay','OrderController@setPay');
    Route::get('order/paystatus/{id}','OrderController@setOrderStatus');
    Route::get('order/getPay/{id}/{cate}/{status}','OrderController@setPayStatus');
    Route::get('order/{id}/{status}','OrderController@setStatus');
    Route::post('order/tosure','OrderController@tosure');
    Route::post('order/add','OrderController@store');
    Route::resource('order','OrderController');
    //在线创作路由
    Route::get('orderpro/comment/{id}/{comment}/{backGold}','OrderProductController@setComment');
    Route::get('orderpro/{id}/destroy','OrderProductController@destroy');
    Route::resource('orderpro','OrderProductController');
    //话题管理
    Route::resource('talk','TalkController');
    Route::get('talk/i/{index}','TalkController@index');      //i代表index
    //钱袋管理
    Route::get('wallet/gettip/{type}/{tip}','WalletController@setTip');     //获取红包
    Route::get('sign','WalletController@signList');         //签到列表
    Route::get('gold','WalletController@goldList');         //金币列表
    Route::get('tip','WalletController@tipList');           //红包列表
    Route::get('wallet/toweal','WalletController@getToWeal');           //福利兑换记录
    Route::get('wallet/useweal/{order}','WalletController@getUseWeal');         //福利兑换记录
    Route::get('wallet/signtoweal/{sign}','WalletController@setWealBySign');    //兑换签到
    Route::get('wallet/goldtoweal/{gold}','WalletController@setWealByGold');    //金币兑换
    Route::get('wallet/tiptoweal/{tip}','WalletController@setWealByTip');       //红包兑换
    Route::resource('wallet','WalletController');
    //配音路由
    Route::resource('dub','DubController');
    //视频投放路由
    Route::resource('delivery','DeliveryController');
    //活动路由
    Route::get('active/apply/{act_id}','ActivityController@getApply');
    Route::resource('active','ActivityController');
});