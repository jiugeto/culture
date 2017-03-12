<?php
namespace App\Api\ApiTalk;

use Curl\Curl;

class ApiTalk
{
    /**
     * 话题接口
     */

    /**
     * 列表
     */
    public static function index($limit=0,$pageCurr=1,$topic=0,$cate=0)
    {
//        $redisKey = 'talkList';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'topic' =>  $topic,
            'cate'  =>  $cate,
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
     * 添加话题
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk/add';
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
     * 添加话题
     */
    public static function modify($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk/modify';
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
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk/show';
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
     * 设置是否删除
     */
    public static function isdel($id,$del)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk/isdel';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
            'del'   =>  $del,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 销毁记录
     */
    public static function delete($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/talk/delete';
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
}