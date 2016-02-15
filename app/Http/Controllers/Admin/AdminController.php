<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoleModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ActionModel;

class AdminController extends BaseController
{
    /**
     * 管理员管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '管理员管理',
            'url'=> 'admin',
        ],
    ];

    public function __construct()
    {
        $this->model = new RoleModel();
    }

    public function index()
    {
        $actions = $this->actions();
        $datas = RoleModel::paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '管理员列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/admin';
        return view('admin.admin.index', compact(
            'actions','datas','crumb','prefix_url'
        ));
    }
}