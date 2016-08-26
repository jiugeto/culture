<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use App\Models\Admin\RoleModel;
use Hash;

class AdminController extends BaseController
{
    /**
     * 管理员管理
     */

    public function __construct()
    {
        parent::__construct();
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
            'prefix_url'=> DOMAIN.'admin/admin',
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
        return redirect(DOMAIN.'admin/admin');
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
        return redirect(DOMAIN.'admin/admin');
    }

    public function pwd($id)
    {
        $curr['name'] = '重置密码';
        $curr['url'] = 'pwd';
        $result = [
            'data'=> AdminModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.pwd', $result);
    }

    public function setPwd(Request $request,$id)
    {
        $adminModel = AdminModel::find($id);
        if (!Hash::check($request->pwd1,$adminModel->password) || $request->pwd1!=$adminModel->pwd) {
            echo "<script>alert('老密码错误！');history.go(-1);</script>";exit;
        }
        if ($request->pwd1!=$request->pwd2) {
            echo "<script>alert('2次老密码不一致！');history.go(-1);</script>";exit;
        }
        $data = [
            'password'=> Hash::make($request->pwd3),
            'pwd'=> $request->pwd3,
            'updated_at'=> time(),
        ];
        AdminModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/admin');
    }

//    public function destroy($id)
//    {
//        AdminModel::where('id',$id)->update(['del'=>1]);
//        return redirect(DOMAIN.'admin/admin');
//    }

    public function forceDelete($id)
    {
        AdminModel::where('id',$id)->delete();
        return redirect(DOMAIN.'admin/admin');
    }





    public function getData(Request $request)
    {
        return array(
            'username'=> $request->username,
            'realname'=> $request->realname,
//            'password'=> $request->password,
//            'email'=> $request->email,
            'role_id'=> $request->role_id,
            'intro'=> $request->intro,
        );
    }

    public function query()
    {
        $datas = AdminModel::orderBy('id','desc')->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}