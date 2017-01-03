<?php
namespace App\Api\ApiOnline;

use Redis;

class ApiBase
{
    /**
     * 在线创作接口
     * API公用文件
     */

    /**
     * 用户接口密匙
     */
    public static function getApiKey()
    {
//        return env('API_KEY', '3TTN5JUf8uLcC3ZxIrszuO9isduc3IKO');
        return '3TTN5JUf8uLcC3ZxIrszuO9isduc3IKO';
    }

    /**
     * 用户接口地址
     */
    public static function getApiCurl()
    {
//        return env('API_CURL', 'online.jiugewenhua.com');
        return 'online_api.jiugewenhua.com';
    }

    /**
     * 对象转为数组
     */
    public static function objToArr($obj)
    {
        return json_decode(json_encode($obj),true);
    }

    /**
     * 获取用户信息缓存
     */
    public static function getRedis($redisKey)
    {
        return Redis::get($redisKey);
    }
}