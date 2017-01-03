<?php
namespace App\Api\ApiTalk;

use Redis;

class ApiBase
{
    /**
     * 话题接口
     * API公用文件
     */

    /**
     * 用户接口密匙
     */
    public static function getApiKey()
    {
//        return env('API_KEY', 'tdcN5L0M21Pw8X9cANI14ox99cUkO2KI');
        return 'tdcN5L0M21Pw8X9cANI14ox99cUkO2KI';
    }

    /**
     * 用户接口地址
     */
    public static function getApiCurl()
    {
//        return env('API_CURL', 'talk.jiugewenhua.com');
        return 'talk_api.jiugewenhua.com';
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