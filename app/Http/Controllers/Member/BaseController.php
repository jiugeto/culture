<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */

    protected $list = [
        ''=> '所有列表',
        'trash'=> '回收站',
    ];
}