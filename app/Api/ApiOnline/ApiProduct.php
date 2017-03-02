<?php
namespace App\Api\ApiOnline;

use Curl\Curl;

class ApiProduct
{
    /**
     * 在线创作产品接口
     */

    /**
     * 列表
     */
    public static function getProductsList($limit=0,$pageCurr=1,$uid=0,$cate=0,$isshow=0)
    {
//        $redisKey = 'productList';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'uid'   =>  $uid,
            'cate'   =>  $cate,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist'  =>   ApiBase::objToArr($response->pagelist),
        );
    }

    /**
     * 根据 id 获取一条记录
     */
    public static function show($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product/show';
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

    /**
     * 增加记录
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product/add';
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
     * 修改记录
     */
    public static function modify($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product/modify';
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
     *  设置是否删除
     */
    public static function setShow($id,$isshow)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product/setshow';
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
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/product/getmodel';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array());
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'model' =>  ApiBase::objToArr($response->model)
        );
    }
}