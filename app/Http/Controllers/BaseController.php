<?php
namespace App\Http\Controllers;

use Session;
use Redis;

class BaseController extends Controller
{
    /**
     * 前台、会员后台、企业后台、个人后台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        $this->setSessionInRedis($this->redisTime);     //同步缓存中session
    }

    /**
     * 判断缓存中的session
     */
    public function setSessionInRedis($redisTime)
    {
        //假如session中有，缓存中没有，则同步为有
        if (Session::get('user') && !Redis::get('cul_session')) {
            $userInfo=Session::get('user');
            $userInfo['cookie'] = $_COOKIE;
            Redis::setex('cul_session',$redisTime,serialize($userInfo));
        }
        //假如session中没有，缓存中有，则同步为有
        if (!Session::get('user') && Redis::get('cul_session')) {
            $cul_session = unserialize(Redis::get('cul_session'));
            $cul_session['cookie'] = $_COOKIE;
            if ($cul_session['cookie']!=$_COOKIE) { echo 'no';exit; }
            Session::put('user',$cul_session);
        }
        //更新session中的cookie值
        if (Session::get('user')) {
            $userInfo=Session::get('user');
            $userInfo['cookie'] = $_COOKIE;
            Redis::setex('cul_session',$redisTime,serialize($userInfo));
            Session::put('user',$userInfo);
        }
    }
}