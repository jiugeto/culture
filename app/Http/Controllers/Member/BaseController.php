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
//    protected $uid;     //登录用户的id

//    protected $list = [
//        ''=> '所有列表',
//        'trash'=> '回收站',
//        'create'=> [
//                'url'=> 'create',
//                'name'=> '创建作品',
//            ],
//        'edit'=> [
//                'url'=> 'edit',
//                'name'=> '修改作品',
//            ],
//        'show'=> [
//                'url'=> 'show',
//                'name'=> '查看详情',
//            ],
//    ];

    public function __construct()
    {
        parent::__construct();
        if (!\Session::has('user')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
        $this->userType = \Session::get('user.userType');
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