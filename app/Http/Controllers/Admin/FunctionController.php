<?php
namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
//use App\Models\Admin\AuthorizationModel;
use App\Models\Admin\FunctionModel;

class FunctionController extends BaseController
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
            'name'=> '前台功能',
            'url'=> 'function',
        ],
    ];

    public function __construct()
    {
        $this->model = new FunctionModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '所有功能';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/function',
        ];
        return view('admin.function.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'function/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
        ];
        return view('admin.function.create', $result);
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
        return FunctionModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}