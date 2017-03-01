<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiSign
{
    /**
     * 金币接口
     */

    /**
     * 签到列表
     */
    public static function index($limit=0,$pageCurr=1,$uid=0)
    {
        $redisKey = 'userSignList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/sign';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist'  =>  ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 通过 uid 获取所有签到记录
     */
    public static function signAll($uid=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/sign/all';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 根据 uid、from、to 得到记录集合
     */
    public static function getSignsByUid($uid,$from,$to)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/sign/getsignsbytime';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'from'  =>  $from,
            'to'    =>  $to,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist'  =>  ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 通过 uid、from、to 时间获取签到记录列表
     */
    public static function getSignListByTime($limit=0,$pageCurr=1,$uid=0,$from,$to)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/sign/signlistbytime';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'   =>  $limit,
            'page'   =>  $pageCurr,
            'uid'   =>  $uid,
            'from'   =>  $from,
            'to'   =>  $to,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist'  =>  ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 新增金币
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/sign/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }
}