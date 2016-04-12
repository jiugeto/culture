<?php
namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\Admin\AuthorizationModel;
use App\Models\Admin\FunctionModel;

class AuthorizationController extends BaseController
{
    /**
     * 系统后台所有细分功能的权限控制统一管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new AuthorizationModel();
        $this->crumb['']['name'] = '用户权限列表';
        $this->crumb['category']['name'] = '用户权限管理';
        $this->crumb['category']['url'] = 'authorization';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/authorization',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.authorization.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.authorization.create', $result);
    }





    /**
     * ====================
     * 以下是公用方法
     * ====================
     */

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = [];
        if ($levelIds = $this->model->getFuncs()) {
            $datas = FunctionModel::where('del',$del)
                ->whereIn('id',$levelIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        if (empty($datas)) {
            $datas = AuthorizationModel::paginate($this->limit);
        }
        return $datas;
    }
}