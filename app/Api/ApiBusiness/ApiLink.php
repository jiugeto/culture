<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiLink
{
    /**
     * 链接接口
     */

    public static function header($limit,$cid,$isshow=0)
    {
        $redisKey = 'culture_header';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/link';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'cid'   =>  $cid,
            'type'  =>  1,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $headerArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$headerArr);
        return array(
            'code' => 0,
            'data' => $headerArr,
        );
    }

    public static function navigate($limit,$cid,$isshow=0)
    {
        $redisKey = 'culture_navigate';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/link';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'cid'   =>  $cid,
            'type'  =>  2,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $navArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$navArr);
        return array(
            'code' => 0,
            'data' => $navArr,
        );
    }

    public static function footer($limit,$cid,$isshow=0)
    {
        $redisKey = 'culture_footer';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/link';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'cid'   =>  $cid,
            'type'  =>  3,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $footerArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$footerArr);
        return array(
            'code' => 0,
            'data' => $footerArr,
        );
    }
}