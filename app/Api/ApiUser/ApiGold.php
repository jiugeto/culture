<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiGold
{
    /**
     * 金币接口
     */

    /**
     * 金币列表
     */
    public static function index($limit,$pageCurr=1,$uid=0)
    {
//        $redisKey = 'userGoldList';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/gold';
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
            'pagelist' => ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 新增金币
     * type：1建议发布奖励1-5，2建议评价奖励6-10，3用户心声奖励1-5，4订单好评奖励5，
     */
    public static function add($uid,$genre)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/gold/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'genre'  =>  $genre,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }
}