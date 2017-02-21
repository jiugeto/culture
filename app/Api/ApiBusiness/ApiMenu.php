<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiMenu
{
    /**
     * 用户后台、企业后台、个人后台、总后台菜单接口
     */

    public static function getMenusByType($type)
    {
//        $redisKey = 'culture_member_menu';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/menusbytype';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'type'  =>  $type,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $menuArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$menuArr);
        return array(
            'code' => 0,
            'data' => $menuArr,
        );
    }


    /**
     * 用户后台、企业后台、个人后台、总后台菜单权限接口
     */
    public static function getAuthList()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/auth';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }
}