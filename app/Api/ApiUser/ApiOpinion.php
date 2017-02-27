<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiOpinion
{
    /**
     * 用户意见接口
     */

    /**
     * 用户意见列表
     */
    public static function getOpinionList($limit=null,$pageCurr=1,$status=0,$isshow=0)
    {
        $redisKey = 'opinionList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'status'    =>  $status,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 用户意见新增
     */
    public static function addOpinion($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/add';
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
     * 用户意见修改
     */
    public static function modifyOpinion($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/modify';
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
     * 根据 uid、fromtime、toTime 获取意见集合
     */
    public static function getOpinionsByTime($uid,$from,$to)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/opinionsbytime';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'from'  =>  $from,
            'to'    =>  $to,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 获取一条用户意见
     */
    public static function getOneOpinion($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/show';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id'    =>  $id,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 设置用户意见删除
     */
    public static function setShow($id,$isshow)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/setshow';
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
     * 销毁记录
     */
    public static function delete($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/delete';
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
     * 设置状态
     */
    public static function setStatus($id,$status,$remarks='')
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/setstatus';
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

    public static function clearTable()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/opinion/clear';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }
}