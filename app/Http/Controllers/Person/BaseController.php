<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiUsers;
use App\Http\Controllers\BaseController as Controller;
use Session;

class BaseController extends Controller
{
    /**
     * 个人后台基础控制器
     */

    protected $links = [
        'space' =>  '空间首页',
        'user'  =>  '资料',
        'video' =>  '视频',
        'product'   =>  '作品',
        'design'    =>  '设计',
        'message'   =>  '留言',
        'frield'    =>  '好友',
        'visitor'   =>  '访问',
        'census'    =>  '统计',
        'sign'  =>  '签到',
        'skin'  =>  '皮肤',
    ];
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
        $this->userid = Session::has('user.uid') ? Session::get('user.uid') : redirect('/login');
        $this->user = $this->getUser($this->userid);
    }

    /**
     * 用户信息
     */
    public function getUser($uid)
    {
        $apiUser = ApiUsers::getOneUser($uid);
        $apiPerson = ApiPerson::getPersonInfo($uid);
        if ($apiUser['code']!=0 || $apiPerson['code']!=0) {
            return array();
        }
        $userInfo = $apiUser['data'];
        $userInfo['areaName'] = AreaNameByid($apiUser['data']['area']);
        $userInfo['realname'] = $apiPerson['data']['realname'];
        $userInfo['sexName'] = $apiPerson['data']['sexName'];
        return $userInfo;
    }
}