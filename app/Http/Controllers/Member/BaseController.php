<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiUsers;
use App\Http\Controllers\BaseController as Controller;
use Session;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        if (!Session::has('user')) { return redirect('/login'); }
        $this->userid = Session::get('user.uid');
        $this->userType = Session::get('user.userType');
    }

    /**
     * 用户自定义参数 limit
     */
    public function getUserLimit()
    {
        $userParam = ApiUsers::getParamByUid($this->userid);
        return $userParam['code']==0?$userParam['data']['limit']:10;
    }
}