<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiPerson
{
    /**
     * 个人资料数据接口
     */

    /**
     * 单个资料
     */
    public static function getPersonInfo($uid)
    {
        $redisKey = 'personInfo';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/person/one';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid' => $uid
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 新增个人资料
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/person/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * ====================
     * 下面是用户朋友方法
     * ====================
     */

    /**
     * 朋友列表
     */
    public static function getFrieldList($limit=null,$pageCurr=1,$uid=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 通过 uid 获取朋友
     */
    public static function getUserFrields($uid,$limit)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/userfrield';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'limit' =>  $limit,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 通过条件查询朋友列表
     */
    public static function getFrieldsOfMenu($limit=null,$pageCurr=1,$uid,$menu)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/frieldsbymenu';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'   =>  $limit,
            'page'   =>  $pageCurr,
            'uid'   =>  $uid,
            'menu'   =>  $menu,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 查找好友列表
     */
    public static function getNewFrields($limit=null,$pageCurr=1,$uid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/newfrields';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'   =>  $limit,
            'page'   =>  $pageCurr,
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 通过 uid 获取一条朋友记录
     */
    public static function getOneFrield($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/onefrield';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'   =>  $id,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 申请添加好友
     */
    public static function addFrield($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/add';
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
     * 设置好友添加的通过、拒绝
     */
    public static function setFrieldAuth($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/frield/auth';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }
}