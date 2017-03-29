<?php
namespace App\Http\Controllers\Company\Admin;

use App\Http\Controllers\BaseController as Controller;
use Session;

class BaseController extends Controller
{
    /**
     * 公司后台控制中心基础控制器
     */

    /**
     * 面包屑
     */
    protected $lists = [
        'main'=> [
            'name'=> '企业后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '功能',
            'url'=> '',
        ],
        ''=> [
            'name'=> '列表',
            'url'=> '',
        ],
        'show'=> [
            'name'=> '详情',
            'url'=> 'show',
        ],
        'create'=> [
            'name'=> '添加',
            'url'=> 'create',
        ],
        'edit'=> [
            'name'=> '修改',
            'url'=> 'edit',
        ],
        'trash'=> [
            'name'=> '回收站',
            'url'=> 'trash',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
        if (Session::has('user.cid')) { $this->cid = Session::get('user.cid'); }
        $this->userid = Session::get('user.uid');
        if (Session::has('user.company')) {
            $this->company = Session::get('user.company');
        }
    }
}