<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\RoleModel;
//use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Models\Admin\ActionModel;

class AdminController extends BaseController
{
    /**
     * 管理员管理
     */

    public function __construct()
    {
        $this->model = new RoleModel();
        $this->crumb['']['name'] = '管理员列表';
        $this->crumb['category']['name'] = '管理员管理';
        $this->crumb['category']['url'] = 'admin';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> RoleModel::paginate($this->limit),
            'prefix_url'=> '/admin/admin',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.index', $result);
    }
}