<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\RoleModel;

class RoleController extends BaseController
{
    /**
     * 系统后台登陆的角色管理
     */

    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '角色管理',
            'url'=> 'role',
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
        $crumb['function']['name'] = '角色列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/role';
        return view('admin.role.index', compact(
            'actions','datas','crumb','prefix_url'
        ));
    }

    public function create()
    {
        $actions = $this->actions();
        $roles = RoleModel::paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加角色';
        $crumb['function']['url'] = 'role/create';
        return view('admin.role.create', compact(
            'actions','roles','crumb'
        ));
    }

    public function store(Request $request)
    {
        $actions = $this->actions();
        $roleModel = $this->getData($request);
        $roleModel->created_at = date('Y-m-d H:m:s', time());
        $roleModel->save();
        return view('admin.role.index', compact('actions'));
    }

//    public function show($id)
//    {
//        $actions = $this->actions();
//        $data = RoleModel::find($id);
//        return view('admin.role.show', compact('actions','data'));
//    }
//
//    public function edit($id)
//    {
//        $actions = $this->actions();
//        $datas = RoleModel::find($id);
//        return view('admin.role.edit', compact('actions'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $actions = $this->actions();
//        $roleModel = $this->getData($request);
//        $roleModel->updated_at = date('Y-m-d H:m:s', time());
//        $roleModel->save();
//        return view('admin.role.index', compact('actions'));
//    }

    public function forceDelete($id)
    {
        RoleModel::find($id)->delete();
    }





    /**
     * =====================
     * 以下是公用方法
     * =====================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $model = $this->model;
        $model->name = $request->name;
        //这里密码要更换 hash 算法
        $model->password = $request->password;
        $model->admin_id = $request->admin_id;
        return $model;
    }

    /**
     * 查询方法
     */
//    public function query(){}
}