<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiOrder
{
    /**
     * 主体业务订单
     */

    public static function index($limit,$pageCurr=1,$isshow=0,$del=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'     =>  $limit,
            'page'      =>  $pageCurr,
            'isshow'    =>  $isshow,
            'del'       =>  $del,
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
     * 通过 uid 获取订单列表
     */
    public static function getOrdersByUid($uid,$status=[])
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/ordersbyuid';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'status'    =>  $status,
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
     * 通过 uid、weal 获取已支付福利记录
     */
    public static function getOrdersByWeal($limit,$pageCurr=1,$uid=0,$isshow=2,$del=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/ordersbyweal';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'     =>  $limit,
            'page'      =>  $pageCurr,
            'uid'       =>  $uid,
            'isshow'    =>  $isshow,
            'del'       =>  $del,
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
     * 通过 uid、limit 获取列表
     */
    public static function getOrdersByLimit($uid=0,$limit=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/ordersbylimit';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'       =>  $uid,
            'limit'     =>  $limit,
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
     * 获取唯一订单记录
     * 通过 genre、fromid、uid、seller、
     */
    public static function getOneByGenre($genre,$fromid,$uid,$seller)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/onebygenre';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'genre'     =>  $genre,
            'fromid'    =>  $fromid,
            'uid'       =>  $uid,
            'seller'    =>  $seller,
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

    public static function show($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/show';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
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

    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/show';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'msg' => $response->error->msg,
        );
    }

    /**
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/getmodel';
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