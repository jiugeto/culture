<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */
    protected $uid;     //登录用户的id

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
        if (\Session::has('user.limit')) {
            $this->limit = UserModel::where('username',\Session::get('user.username'))->first()->limit;
        }
    }
}