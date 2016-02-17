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

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '用户权限分配',
            'name'=> '功能权限',
            'url'=> 'authorization',
        ],
    ];

    public function __construct()
    {
        $this->model = new AuthorizationModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '功能权限列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/authorization',
        ];
        return view('admin.authorization.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'authorization/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
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