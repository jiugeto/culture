<?php
namespace App\Http\Controllers\Company\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\ComMainModel;
use App\Models\CompanyModel;

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
        $this->userid = \Session::get('user.uid');
        if (\Session::has('user.company')) {
            $this->company = unserialize(\Session::get('user.company'));
            $this->cid = $this->company['cid'];
        } else {
//            echo "<script>alert('你还木有做公司认证！');</script>";exit;
//            return redirect('/member/setting/'.$this->userid.'/auth');
        }
    }
}