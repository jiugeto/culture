<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiIdea
{
    /**
     * 创意接口
     */

    public static function index($limit,$pageCurr=1,$uid=0,$cate=0,$isshow=2,$del=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/idea';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'uid'   =>  $uid,
            'isshow'    =>  $isshow,
            'cate'  =>  $cate,
            'del'   =>  $del,
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

    /**
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/idea/getmodel';
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
            'model' => ApiBase::objToArr($response->model),
        );
    }
}