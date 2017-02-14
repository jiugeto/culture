<?php
namespace App\Api\ApiBusiness;

use Redis;

class ApiBase
{
    /**
     * 业务接口
     * API公用文件
     */

    /**
     * 用户接口密匙
     */
    public static function getApiKey()
    {
        return 'ge5T53IMlkiDLk8jcWldtAnZAgeMCi3t';
    }

    /**
     * 用户接口地址
     */
    public static function getApiCurl()
    {
        return 'business_api.jiugewenhua.com';
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

    /**
     * 设置用户信息缓存
     */
    public static function setRedis($redisKey,$val)
    {
        return Redis::setex($redisKey,3600*5,serialize($val));     //给它缓存5个小时
    }
}