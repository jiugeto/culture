<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin\RoleModel;

class RoleController extends BaseController
{
    /**
     * 系统后台登陆的角色管理
     */

    public function __construct()
    {
        $this->model = new RoleModel();
        $this->crumb['']['name'] = '角色列表';
        $this->crumb['category']['name'] = '角色管理';
        $this->crumb['category']['url'] = 'role';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> RoleModel::paginate($this->limit),
            'prefix_url'=> '/admin/role',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
//            'actions'=> $this->actions(),
//            'roles'=> RoleModel::paginate($this->limit),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.create', $result);
    }

    public function store(Request $request)
    {
//        $actions = $this->actions();
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:m:s', time());
        RoleModel::create($data);
        return redirect('/admin/role');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> RoleModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.show',$result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> RoleModel::paginate($this->limit),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:m:s', time());
        RoleModel::where('id',$id)->update($data);
        return redirect('/admin/role');
    }

    public function forceDelete($id)
    {
        RoleModel::where('id',$id)->delete();
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