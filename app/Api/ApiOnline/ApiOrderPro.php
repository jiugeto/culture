<?php
namespace App\Api\ApiOnline;

use Curl\Curl;

class ApiOrderPro
{
    /**
     * 创作订单接口
     */

    /**
     * 列表
     */
    public static function index($limit=0,$pageCurr=1,$uid=0,$cate=0,$isshow=0,$status=0)
    {
        $redisKey = 'orderProList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'uid'   =>  $uid,
            'cate'  =>  $cate,
            'isshow'    =>  $isshow,
            'status'    =>  $status
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'model' => ApiBase::objToArr($response->model),
        );
    }

    /**
     * 根据 uid、limit 获取记录
     */
    public static function getOrders($uid=0,$limit=0)
    {
        $redisKey = 'orderPros';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/getorders';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'limit'  =>  $limit,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'model' => ApiBase::objToArr($response->model),
            'data' => ApiBase::objToArr($response->data),
        );
    }

    /**
     * 增加订单
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 更新视频链接
     */
    public static function modifyLink($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/modifylink';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 根据 id 获取一条记录
     */
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
            'model' => ApiBase::objToArr($response->model),
            'data' => ApiBase::objToArr($response->data),
            );
    }

    /**
     * 通过 id、isshow 设置是否显示
     */
    public static function setIsShow($id,$isshow)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/isshow';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 设置状态
     */
    public static function setStatus($id,$status)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/status';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
            'status'    =>  $status,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 好评返金币
     */
    public static function backGold($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/backgold';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/getmodel';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array());
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'model' => ApiBase::objToArr($response->model));
    }

    public static function clearTable($uname)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/order/clear';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uname' =>  $uname,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }
}