<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiUsers;
use App\Http\Controllers\Controller;
use App\Models\UserModel;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        if (!\Session::has('user')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
        $this->userType = \Session::get('user.userType');
//        dd(\Session::get('user'),unserialize(\Redis::get('cul_session')),$_COOKIE);
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