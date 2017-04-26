<?php
/**
 * 这里是前台页面路由
 */

//Route::get('home',function(){
//    return 'home';
//});


Route::group(['prefix'=>'/','namespace'=>'Home'],function(){
    //前台首页路由
    Route::get('/','HomeController@index');
    Route::get('home','HomeController@index');
    //产品样片
    Route::get('product','ProductController@index');
    Route::get('product/s/{ptype}','ProductController@index');    //s代表检索
    Route::get('product/{id}','ProductController@show');
    Route::get('product/click/{id}/{num}','ProductController@setClick');
    Route::get('product/video/{id}/{videoid}','ProductController@video');
    Route::get('product/cus/{cus_id}/supply','ProductController@cusSupplyList');    //某个片源的供应列表
    Route::post('product/addProCus','ProductController@insertProCus');    //新增片源
    Route::post('product/addCus','ProductController@insertCus');    //申请片源
    //在线作品
    Route::get('creation/s/{genre}/{cate}/{isorder}','CreationController@index');
    Route::get('creation','CreationController@index');
    Route::get('creation/pre/{id}','CreationController@pre');
    //供应单位
    Route::get('supply/s/{genre}','SupplyController@index');
    Route::get('supply','SupplyController@index');
    //需求信息
    Route::get('demand/s/{genre}','DemandController@index');
    Route::get('demand/{genre}/{id}','DemandController@getShowByGenre');
    Route::get('demand','DemandController@index');
    //娱乐频道
    Route::get('entertain/s/{genre0}/{type}','EntertainController@index');     //s代表检索
    Route::get('entertain','EntertainController@index');
    Route::get('entertain/{id}','EntertainController@show');
    Route::get('entertain/staff/show/{id}','EntertainController@staffShow');
    Route::get('entertain/works/show/{id}','EntertainController@worksShow');
    //租赁频道
    Route::get('rent/SD/{genre}','RentController@index');
    Route::get('rent/s/{type}/{from}/{to}','RentController@index');     //s代表检索
    Route::resource('rent','RentController');
    //设计频道
    Route::get('design/s/{cate}','DesignController@index');     //s代表检索
    Route::resource('design','DesignController');
    //创意路由
    Route::get('idea/click/{id}/{click}','IdeaController@click');
    Route::get('idea/collect/{id}/{collect}','IdeaController@collect');
    Route::get('idea/s/{cate}','IdeaController@index');     //s代表检索
    Route::resource('idea','IdeaController');
    //视频投放媒介
    Route::get('delivery/s/{genre}','DeliveryController@index');        //s代表检索
    Route::resource('delivery','DeliveryController');
    //配音频道
    Route::get('dub/s/{genre}','DubController@index');          //s代表检索
    Route::resource('dub','DubController');
    //关于我们
//    Route::get('about','AboutController@index');
//    Route::get('about/join','AboutController@join');
//    Route::get('about/station','AboutController@station');
    //用户心声
    Route::resource('uservoice','UserVoiceController');
    //用户对本站的意见栏
    Route::post('opinion/status/{id}','OpinionController@setStatus');
    Route::get('opinion/status/{id}','OpinionController@getStatus');
    Route::post('opinion/{id}','OpinionController@update');
    Route::get('opinion/s/{status}','OpinionController@index');
    Route::resource('opinion','OpinionController');
    //新手帮助路由
    Route::resource('help','HelpController');
    //搜索栏
    Route::get('s/{genre}/{keyword}','SearchController@index');
    Route::get('s/init','SearchController@init');      //搜索表初始化
});