<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * 这里是micro culture的主路由
 */

//友好路由
Route::get('/', function () {
//    return view('layout.child');
    return view('welcome');
});

/**
 * home代表首页
 */

//载入前台路由
include("routes/routes_home.php");

//载入后台路由
include("routes/routes_admin.php");

//载入会员路由
include("routes/routes_member.php");