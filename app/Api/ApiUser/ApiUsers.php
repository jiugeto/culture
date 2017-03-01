<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiUsers
{
    /**
     * 用户数据接口
     */

    /**
     * 获取用户列表
     */
    public static function getUserList($isuser=0,$isauth=0,$limit=null,$pageCurr=1)
    {
        $redisKey = 'userList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'isuser'    =>  $isuser,
            'isauth'    =>  $isauth,
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code'  =>  0,
            'data'  =>  ApiBase::objToArr($response->data),
            'pagelist'  =>  ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 根据时间获取用户
     */
    public static function getUsersByTime($time=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/getusersbytime';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'time'  =>  $time,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
            'pagelist'  =>  ApiBase::objToArr($response->pagelist),
            );
    }

    /**
     * 由 uid 获取一条用户信息
     */
    public static function getOneUser($uid)
    {
        $redisKey = 'oneUserInfo';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/oneuser';
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
     * 由 username 获取用户记录
     */
    public static function getOneUserByUname($uname)
    {
        $redisKey = 'oneUserByUname';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/oneuserbyuname';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uname' => $uname
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 新用户注册
     */
    public static function doRegist($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/doregist';
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
     * 用户登录
     */
    public static function doLogin($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/dologin';
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
     * 更新用户信息
     */
    public static function modify($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/modify';
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
     * 更新用户密码
     */
    public static function modifyPwd($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/modifypwd';
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
     * 设置审核
     */
    public static function setAuth($uid,$auth)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/auth';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'auth'  =>  $auth,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 换头像
     */
    public static function setHead($uid,$head)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/head';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
            'pic_id'  =>  $head,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * ====================
     * 下面是用户参数方法
     * ====================
     */

    /**
     * 获取用户自定义参数
     */
    public static function getParamByUid($uid)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/userparam';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid'   =>  $uid,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'data' => ApiBase::objToArr($response->data));
    }

    /**
     * 设置个人后台顶部背景图
     */
    public static function setPersonTopBg($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/userparam/persontopbg';
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
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/user/getmodel';
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