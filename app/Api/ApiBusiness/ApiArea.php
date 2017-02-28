<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiArea
{
    /**
     * 地区接口
     */

    public static function index($limit,$pageCurr=1)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/area';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
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

//    public static function getAreas(){}

    public static function getNameById($area_id,$type=1)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/area/namebyid';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'area_id'   =>  $area_id,
            'type'  =>  $type,
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

    public static function getAreaByName($areaName)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/area/areabyname';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'areaName'   =>  $areaName,
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