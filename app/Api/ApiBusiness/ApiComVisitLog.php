<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiComVisitLog
{
    /**
     * 公司访问日志
     */

    public static function index($limit,$pageCurr=1,$cid=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/com/visitlog';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'     =>  $limit,
            'page'      =>  $pageCurr,
            'cid'    =>  $cid,
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
}