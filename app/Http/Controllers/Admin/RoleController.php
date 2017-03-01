<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiAction;
use App\Api\ApiUser\ApiAdmin;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * 系统后台登陆的角色管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '角色列表';
        $this->crumb['category']['name'] = '角色管理';
        $this->crumb['category']['url'] = 'role';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/role';
        $apiAdmin = ApiAdmin::roleList($this->limit,$pageCurr);
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
        return view('admin.role.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiAdmin::addRole($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/role');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiAdmin::roleShow($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.show',$result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiAdmin::roleShow($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiAdmin::modifyRole($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/role');
    }

    public function forceDelete($id)
    {
        $rst = ApiAdmin::deleteRole($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/role');
    }

    /**
     * 权限操作页面
     */
    public function getRoleAction($id)
    {
        $curr['name'] = '权限编辑';
        $curr['url'] = $this->crumb['edit']['url'];
        $rstRole = ApiAdmin::roleShow($id);
        if ($rstRole['code']!=0) {
            echo "<script>alert('".$rstRole['msg']."');history.go(-1);</script>";exit;
        }
        $rstActions = ApiAction::actionAll();
        if ($rstActions['code']!=0) {
            echo "<script>alert('".$rstActions['msg']."');history.go(-1);</script>";exit;
        }
//        dd($rstRole,$rstActions['data']);
        $result = [
            'data'=> $rstRole['data'],
//            'actions'=> $this->model->getActions(),
            'actions'=> $rstActions['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.editAction', $result);
    }

    /**
     * 更新权限
     */
    public function setRoleAction(Request $request,$id)
    {
        if (!$request->action) {
            echo "<script>alert('操作必选！');history.go(-1);</script>";exit;
        }
        $data = $request->all();
        $data['role_id'] = $id;
        $rst = ApiAdmin::setRoleAction($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');</script>";exit;
        }
        return redirect(DOMAIN."admin/role");
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
        ];
        return $data;
    }
}