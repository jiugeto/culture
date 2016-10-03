<?php

/**
 * 在线创作路由
 */

//用户自己的创作房间
Route::group(['prefix'=>'online/u','middleware' =>'MemberAuth','namespace'=>'Online'],function(){
    //会员作品
    Route::get('product/getpro/{id}','ProductController@getPro');       //获取创作模板
    Route::get('product/pre/{id}','ProductController@show');
    Route::get('product/c/{cate}','ProductController@index');
    Route::resource('product','ProductController');
    //编辑作品
//    Route::get('{productid}/frame/addLayerAttr/{layerid}/{con_id}/{genre}/{layerAttr}/{per}/{val}','FrameController@insertLayerAttr');                        //关键帧添加
    Route::post('{productid}/frame/editLayerAttr/{layerAttrId}','FrameController@updateLayerAttr');                        //关键帧更新
    Route::post('{productid}/frame/addLayerAttr','FrameController@insertLayerAttr');                        //关键帧添加
    Route::post('{productid}/frame/editAttr/{attrid}','FrameController@updateAttr');                        //属性样式更新
    Route::post('{productid}/frame/addAttr','FrameController@insertAttr');                        //属性样式添加
    Route::post('{productid}/frame/editCon/{con_id}','FrameController@updateCon');                        //动画内容更新
    Route::post('{productid}/frame/addCon','FrameController@insertCon');                        //动画内容添加
    Route::post('{productid}/frame/editLayer/{layerid}','FrameController@updateLayer');                        //动画设置修改
    Route::post('{productid}/frame/addLayer','FrameController@insertLayer');                        //动画设置添加
    Route::get('{productid}/frame/{layerid}/{con_id}/{attrGenre}','FrameController@index');            //编辑页面
    Route::resource('{productid}/frame','FrameController');
    Route::get('{productid}/frame/play2/{layerid}/{con_id}/{attrid}', 'HomeController@play');       //动画模板
});

//创作效果样片大厅
Route::group(['prefix'=>'online','namespace'=>'Online'],function() {
    //模板大厅
    Route::get('', 'HomeController@index');
    Route::get('c/{cate}', 'HomeController@index');
    //在线预览
    Route::get('pre/{id}', 'HomeController@show');
    //动画模板
    Route::get('pro/play/{id}', 'HomeController@play');
});

//用户参数路由
Route::group(['prefix'=>'','middleware' =>'MemberAuth','namespace'=>'Common'],function() {
    Route::get('footSwitch/set/{footSwitch}', 'UserParamsController@setFootSwitch');
});