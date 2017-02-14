<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiProVideo
{
    /**
     * 离线模板、效果定制接口
     */

    public static function index($limit,$pageCurr=1,$genre,$cate=0,$uid=0,$isshow=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/provideo';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'     =>  $limit,
            'page'      =>  $pageCurr,
            'genre'     =>  $genre,
            'cate'      =>  $cate,
            'uid'       =>  $uid,
            'isshow'    =>  $isshow,
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