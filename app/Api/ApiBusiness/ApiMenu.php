<?php
namespace App\Api\ApiBusiness;

use Curl\Curl;

class ApiMenu
{
    /**
     * 用户后台、企业后台、个人后台、总后台菜单接口
     */

    public static function index($limit,$pageCurr=1,$type=0,$isshow=2)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'limit'     =>  $limit,
            'pageCurr'  =>  $pageCurr,
            'type'      =>  $type,
            'isshow'    =>  $isshow,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $menuArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$menuArr);
        return array(
            'code' => 0,
            'data' => $menuArr,
        );
    }

    /**
     * 通过 type 获取菜单列表
     * type：1member、2person、3company
     */
    public static function getMenusByType($type=0)
    {
//        $redisKey = 'culture_member_menu';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/menusbytype';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'type'  =>  $type,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -1, 'msg' => $response->error->msg);
        }
        $menuArr = ApiBase::objToArr($response->data);
//        ApiBase::setRedis($redisKey,$menuArr);
        return array(
            'code' => 0,
            'data' => $menuArr,
        );
    }

    public static function show($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/show';
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
     * 设置菜单是否显示
     */
    public static function addMenu($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/add';
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
     * 设置菜单是否显示
     */
    public static function modifyMenu($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/modify';
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
     * 设置菜单是否显示
     */
    public static function setShow($id,$isshow)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/setshow';
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
        return array(
            'code' => 0,
            'msg' => $response->error->msg,
        );
    }

    /**
     * 获取顶级菜单
     */
    public static function getMenuParent()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/parent';
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

    /**
     * 获取菜单 model
     */
    public static function getMenuModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/getmodel';
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




    /**
     * ==========================================
     * 用户后台、企业后台、个人后台、总后台菜单权限接口
     */
    public static function getAuthList()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/auth';
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

    /**
     * 通过 userType 获取权限
     */
    public static function getAuthsByUserType($userType=0)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/auth/authsbyusertype';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'userType'  =>  $userType,
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
     * 设置权限
     */
    public static function setAuth($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/auth/setauth';
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
     * 获取权限 model
     */
    public static function getAuthModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/menu/auth/getmodel';
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