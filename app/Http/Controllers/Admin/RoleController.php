<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\RoleActionModel;
use Illuminate\Http\Request;
use App\Models\Admin\RoleModel;

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
        $this->model = new RoleModel();
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/role',
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
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        RoleModel::create($data);
        return redirect(DOMAIN.'admin/role');
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
            'data'=> RoleModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.role.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        RoleModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/role');
    }

    public function forceDelete($id)
    {
        RoleModel::where('id',$id)->delete();
    }

    /**
     * 权限操作页面
     */
    public function getRoleAction($id)
    {
        $curr['name'] = '权限编辑';
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> RoleModel::find($id),
            'actions'=> $this->model->getActions(),
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
        $roleActions = RoleActionModel::where('role_id',$id)->get();
        //多余的就删除
        foreach ($roleActions as $roleAction) {
            if (!in_array($roleAction->action_id,$request->action)) {
                RoleActionModel::where('id',$roleAction->id)->delete();
            }
        }
        //没有的就添加
        foreach ($request->action as $action) {
            if (!RoleActionModel::where('role_id',$id)->where('action_id',$action)->first()) {
                $data = [
                    'role_id'=> $id,
                    'action_id'=> $action,
                    'created_at'=> time(),
                ];
                RoleActionModel::create($data);
            }
        }
        return redirect(DOMAIN.'admin/role');
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
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas = RoleModel::orderBy('id','asc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}