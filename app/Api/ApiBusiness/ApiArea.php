<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiArea
{
    /**
     * 地区接口
     */

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
}