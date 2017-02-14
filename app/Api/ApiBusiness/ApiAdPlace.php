<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiAdPlace
{
    /**
     * 广告位接口
     */

    public static function index()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/adplace';
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