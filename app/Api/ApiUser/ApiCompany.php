<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiCompany
{
    /**
     * 个人资料数据接口
     */

    /**
     * 获取公司列表
     */
    public static function getCompanyList($limit=null)
    {
        $redisKey = 'companyList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl,array(
            'limit' =>  $limit,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 由 uid 获取一条公司数据
     */
    public static function getCompanyInfo($uid)
    {
        $redisKey = 'companyInfo';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/one';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid' => $uid
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }
}