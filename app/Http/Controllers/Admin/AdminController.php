<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiAdmin;
use Illuminate\Http\Request;
//use App\Models\Admin\AdminModel;
//use App\Models\Admin\RoleModel;
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
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/admin';
        $apiAdmin = ApiAdmin::getAdminList($this->limit,$pageCurr);
        if ($apiAdmin['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiAdmin['data']; $total = $apiAdmin['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.admin.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'roleModels'=> ApiAdmin::allRoles(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiAdmin::addAdmin($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/admin');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rstAdmin = ApiAdmin::getOneAdmin($id);
        if ($rstAdmin['code']!=0) {
            echo "<script>alert('".$rstAdmin['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rstAdmin['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rstAdmin = ApiAdmin::getOneAdmin($id);
        $data = $rstAdmin['code']==0 ? $rstAdmin['data'] : [];
        $result = [
            'data'=> $data,
            'roleModels'=> ApiAdmin::allRoles(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $rst = ApiAdmin::modifyAdmin($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/admin');
    }

    public function pwd($id)
    {
        $curr['name'] = '重置密码';
        $curr['url'] = 'pwd';
        $rstAdmin = ApiAdmin::getOneAdmin($id);
        $data = $rstAdmin['code']==0 ? $rstAdmin['data'] : [];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.admin.pwd', $result);
    }

    public function setPwd(Request $request,$id)
    {
        $data = [
            'password'=> Hash::make($request->pwd3),
            'pwd'=> $request->pwd3,
            'id'=> $id,
        ];
        $rst = ApiAdmin::modifyAdminPwd($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/admin');
    }

    public function forceDelete($id)
    {
        $rst = ApiAdmin::deleteAdmin($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/admin');
    }





    public function getData(Request $request)
    {
        return array(
            'username'=> $request->username,
            'realname'=> $request->realname,
            'role_id'=> $request->role_id,
            'intro'=> $request->intro,
        );
    }

    public function query($pageCurr,$prefix_url)
    {
        return $datas;
    }
}