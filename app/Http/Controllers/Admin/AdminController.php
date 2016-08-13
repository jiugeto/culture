<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use App\Models\Admin\RoleModel;

class AdminController extends BaseController
{
    /**
     * 管理员管理
     */

    public function __construct()
    {
        parent::__construct();
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
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/admin',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'roleModels'=> RoleModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        AdminModel::create($data);
        return redirect('/admin/admin');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> AdminModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> AdminModel::find($id),
            'roleModels'=> RoleModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        AdminModel::where('id',$id)->update($data);
        return redirect('/admin/admin');
    }

//    public function destroy($id)
//    {
//        AdminModel::where('id',$id)->update(['del'=>1]);
//        return redirect('/admin/admin');
//    }

    public function forceDelete($id)
    {
        AdminModel::where('id',$id)->delete();
        return redirect('/admin/admin');
    }





    public function query()
    {
        $datas = AdminModel::orderBy('id','desc')->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'username'=> $request->username,
            'realname'=> $request->realname,
            'password'=> $request->password,
            'email'=> $request->email,
            'role_id'=> $request->role_id,
            'intro'=> $request->intro,
        ];
        return $data;
    }
}