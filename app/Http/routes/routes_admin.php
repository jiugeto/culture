<?php
/**
 * 系统后台权限
 */
Route::group(['prefix' => 'admin','namespace'=>'Admin'], function(){
    Route::get('login', 'LoginController@login');
    Route::post('login', 'LoginController@dologin');
    Route::get('logout', 'LoginController@dologout');
});

/**
 * 这里是系统后台路由
 */
Route::group(['prefix'=>'admin','middleware' => 'AdminAuth','namespace'=>'Admin'],function(){
//Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //系统后台首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
    //权限管理
        //管理员路由
    Route::post('admin/{id}','AdminController@update');
    Route::get('admin/{id}/forceDelete','AdminController@forceDelete');
    Route::get('admin/pwd/{id}','AdminController@pwd');
    Route::post('admin/setpwd/{id}','AdminController@setPwd');
    Route::resource('admin','AdminController');
        //角色路由
    Route::post('role/{id}','RoleController@update');
    Route::get('role/{id}/forceDelete','RoleController@forceDelete');
    Route::resource('role','RoleController');
        //权限操作路由
    Route::post('role/action/{id}','RoleController@setRoleAction');
    Route::get('role/action/{id}','RoleController@getRoleAction');
        //操作路由
    Route::get('action/create/{pid}','ActionController@create');
    Route::post('action/{id}','ActionController@update');
    Route::get('action/increase/{id}','ActionController@increase');
    Route::get('action/reduce/{id}','ActionController@reduce');
    Route::get('action/{id}/destroy','ActionController@destroy');
    Route::get('action/{id}/restore','ActionController@restore');
    Route::get('action/{id}/forceDelete','ActionController@forceDelete');
    Route::get('action/isshow/{id}/{pid}/{isshow}','ActionController@setIsShow');
    Route::get('action/s/{isshow}/{pid}','ActionController@index');         //s代表检索
    Route::resource('action','ActionController');
        //用户权限分配
    Route::post('auth/getAuth/{auth}','AuthsController@setAuth');
    Route::get('auth/edit/{auth}','AuthsController@edit');
    Route::resource('auth','AuthsController');
        //前台左侧菜单链接功能
    Route::post('menus/{id}','MenusController@update');
    Route::get('menus/{id}/forceDelete','MenusController@forceDelete');
    Route::get('menus/s/{type}/{isshow}','MenusController@index');      //s代表检索
    Route::get('menus/isshow/{id}/{isshow}','MenusController@setIsShow');
    Route::resource('menus','MenusController');
    //资料审核
        //会员管理
    Route::get('user/toauth/{id}','UserController@toauth');
    Route::get('user/noauth/{id}','UserController@noauth');
    Route::get('user/increase/{id}','UserController@increase');
    Route::get('user/reduce/{id}','UserController@reduce');
    Route::get('user/limit/{id}/{limit}','UserController@limit');
    Route::post('user/{id}','UserController@update');
    Route::get('user/s/{isauth}/{isuser}','UserController@index');
    Route::resource('user','UserController');
    //作品管理（制作公司和设计师的）
    Route::get('goods/s/{genre}/{cate}','GoodsController@index');
    Route::post('goods/{id}','GoodsController@update');
    Route::post('goods/thumb/{id}','GoodsController@setThumb');
    Route::post('goods/link/{id}','GoodsController@setLink');
    Route::get('goods/setshow/{id}/{isshow}','GoodsController@setShow');
    Route::resource('goods','GoodsController');
    //在线模板路由
    Route::post('temp/{id}','ProTempController@update');
    Route::post('temp/thumb/{id}','ProTempController@setThumb');
    Route::post('temp/link/{id}','ProTempController@setLink');
    Route::get('temp/setshow/{id}/{isshow}','ProTempController@setShow');
    Route::resource('temp','ProTempController');
    //在线动画路由
    Route::post('product/{id}','ProductController@update');
    Route::get('product/setshow/{id}/{isshow}','ProductController@setShow');
    Route::resource('product','ProductController');
    //离线动画路由
//    Route::get('provideo/pre/{id}','ProductVideoController@pre');   //预览视频
    Route::post('provideo/{id}','ProductVideoController@update');
    Route::get('provideo/s/{genre}','ProductVideoController@index');
    Route::post('provideo/thumb/{id}','ProductVideoController@setThumb');
    Route::post('provideo/link/{id}','ProductVideoController@setLink');
    Route::get('provideo/show/{id}/{isshow}','ProductVideoController@setShow');
    Route::get('provideo/clear','ProductVideoController@clearTable');
    Route::resource('provideo','ProductVideoController');
    //租赁路由
    Route::post('rent/{id}','RentController@update');
    Route::get('rent/s/{genre}/{type}','RentController@index');
    Route::post('rent/thumb/{id}','RentController@setThumb');
    Route::post('rent/setshow/{id}/{isshow}','RentController@setShow');
    Route::resource('rent','RentController');
    //娱乐路由
    Route::post('entertain/{id}','EntertainController@update');
    Route::post('entertain/thumb/{id}','EntertainController@setThumb');
    Route::get('entertain/show/{id}/{isshow}','EntertainController@setShow');
    Route::resource('entertain','EntertainController');
        //人员管理
//    Route::get('staff/{id}/destroy','StaffController@destroy');
//    Route::get('staff/{id}/restore','StaffController@restore');
//    Route::get('staff/{id}/forceDelete','StaffController@forceDelete');
    Route::post('staff/{id}','StaffController@update');
    Route::resource('staff','StaffController');
    //设计路由
    Route::post('design/{id}','DesignController@update');
    Route::post('design/thumb/{id}','DesignController@setThumb');
    Route::get('design/show/{id}/{isshow}','DesignController@setShow');
//    Route::get('design/trash','DesignController@trash');
    Route::resource('design','DesignController');
    //功能管理
        //消息管理
//    Route::get('message/trash','MessageController@trash');
    Route::get('message/show/{id}/show','MessageController@setShow');
    Route::resource('message','MessageController');
        //链接管理
    Route::post('link/{id}','LinkController@update');
    Route::get('link/s/{type}','LinkController@index');
    Route::post('link/thumb/{id}','LinkController@setThumb');
    Route::get('link/show/{id}/{isshow}','LinkController@setShow');
    Route::resource('link','LinkController');
        //心声管理
    Route::post('uservoice/{id}','UserVoiceController@update');
    Route::get('uservoice/show/{id}/{isshow}','UserVoiceController@setShow');
    Route::resource('uservoice','UserVoiceController');
        //用户意见管理
    Route::get('opinions/clear','OpinionsController@clearTable');     //清空表
    Route::post('opinions/{id}','OpinionsController@update');
//    Route::get('opinions/{id}/destroy','OpinionsController@destroy');
//    Route::get('opinions/{id}/restore','OpinionsController@restore');
//    Route::get('opinions/{id}/forceDelete','OpinionsController@forceDelete');
//    Route::get('opinions/trash','OpinionsController@trash');
//    Route::get('opinions/{isshow}/trash','OpinionsController@trash');
    Route::get('opinions/s/{isshow}','OpinionsController@index');
    Route::get('opinions/show/{id}/{isshow}','OpinionsController@setShow');
    Route::resource('opinions','OpinionsController');
    //用户日志管理
    Route::resource('userlog','UserlogController');
    Route::resource('adminlog','AdminlogController');
    //地区管理
    Route::post('area/{id}','AreaController@update');
    Route::resource('area','AreaController');
    //企业页面功能管理
    //企业主页路由
    Route::post('commain/{id}','ComMainController@update');
    Route::post('commain/logo/{id}','ComMainController@setLogo');
    Route::resource('commain','ComMainController');
    //企业模块路由
    Route::post('commodule/init','ComModuleController@setInit');
    Route::post('commodule/{id}','ComModuleController@update');
    Route::resource('commodule','ComModuleController');
    //企业功能路由
    Route::post('comfunc/init','ComFuncController@setInit');
    Route::post('comfunc/{id}','ComFuncController@update');
    Route::resource('comfunc','ComFuncController');
    //访问日志路由
    Route::post('visit/{id}','VisitlogController@update');
    Route::get('visit/u/{g}/{uname}','VisitlogController@index');
    Route::resource('visit','VisitlogController');
    //广告管理
    Route::post('ad/{id}','AdController@update');
    Route::get('ad/use/{id}/{use}','AdController@setUse');
    Route::post('ad/thumb/{id}','AdController@setThumb');
    Route::resource('ad','AdController');
    //广告位管理
    Route::post('place/{id}','AdPlaceController@update');
    Route::resource('place','AdPlaceController');
    //创意管理
    Route::post('idea/{id}','IdeaController@update');
    Route::get('idea/show/{id}/{isshow}','IdeaController@setShow');
    Route::resource('idea','IdeaController');
    //分镜管理
    Route::post('storyboard/{id}','StoryBoardController@update');
    Route::post('storyboard/thumb/{id}','StoryBoardController@setThumb');
    Route::get('storyboard/show/{id}/{isshow}','StoryBoardController@setShow');
//    Route::get('storyboard/{id}/destroy','StoryBoardController@destroy');
//    Route::get('storyboard/{id}/restore','StoryBoardController@restore');
//    Route::get('storyboard/{id}/forceDelete','StoryBoardController@forceDelete');
//    Route::get('storyboard/trash','StoryBoardController@trash');
    Route::resource('storyboard','StoryBoardController');
    //订单路由
    Route::get('order/{del}/{isshow}','OrderController@index');
    Route::post('order/{id}','OrderController@update');
    Route::resource('order','OrderController');
    //售后路由
    Route::get('orderfirm/{del}/{isshow}','OrderFirmController@index');
    Route::post('orderfirm/{id}','OrderFirmController@update');
    Route::resource('orderfirm','OrderFirmController');
    //在线订单路由
    Route::get('ordercre/status/{id}/{status}','OrderCreController@setStatus');
    Route::get('ordercre/isshow/{id}/{isshow}','OrderCreController@setShow');
    Route::post('ordercre/{id}','OrderCreController@update');
    Route::get('ordercre/s/{isshow}/{status}','OrdercreController@index');      //s代表检索
    Route::get('ordercre/clear','OrderCreController@clearTable');
    Route::resource('ordercre','OrderCreController');
    //钱包管理
    Route::post('wallet/weal/{id}','WalletController@setWeal');
    Route::get('wallet/toweal/{id}/{type}','WalletController@getWeal');
    Route::get('tip','WalletController@tipList');
    Route::get('gold','WalletController@goldList');
    Route::get('sign','WalletController@signList');
    Route::post('wallet/{id}','WalletController@update');
    Route::resource('wallet','WalletController');
    /**
     * **********
     * 论坛路由
     */
    Route::group(['prefix' => '/','namespace'=>'Forum'], function(){
        //专栏路由
        Route::post('topic','TopicController@update');
        Route::resource('topic','TopicController');
        //类别管理
        Route::post('cate/{id}','CateController@update');
        Route::resource('cate','CateController');
        //话题管理
        Route::post('talk/{id}','TalkController@update');
        Route::get('talk/isdel/{id}/{del}','TalkController@isdel');
        Route::get('talk/s/{uname}','TalkController@index');        //s代表检索
        Route::resource('talk','TalkController');
    });
});