<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\ActionModel;

class ActionController extends BaseController
{
    /**
     * 权限管理
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
                'name'=> '权限管理',
                'url'=> 'action',
            ],
    ];

    public function __construct()
    {
        $this->model = new ActionModel();
    }

    public function index()
    {
        $actions = $this->actions();
        $datas = ActionModel::paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '权限列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/action';
        $result = [
            'actions'=> $actions,
            'datas'=> $datas,
            'crumb'=> $crumb,
            'prefix_url'=> $prefix_url,
        ];
        return view('admin.action.index', $result);
    }

    public function create($pid=0)
    {
        $actions = $this->actions();
        $parent = $this->parent($pid);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加操作';
        $crumb['function']['url'] = 'action/create';
        return view('admin.action.create', compact(
            'actions','parent','crumb'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:m:s', time());
        ActionModel::create($data);
        return redirect('/admin/action');
    }

    public function show($id)
    {
        $actions = $this->actions();
        $data = ActionModel::find($id);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '操作细节';
        $crumb['function']['url'] = 'action/show';
        return view('admin.action.show', compact(
            'actions','data','crumb'
        ));
    }

    public function edit($id)
    {
        $actions = $this->actions();
        $pactions = ActionModel::where('pid',0)->get();
        $data = ActionModel::find($id);
        $parent = $this->parent($id);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '修改操作';
        $crumb['function']['url'] = 'action/edit';
        return view('admin.action.edit', compact(
            'actions','pactions','data','parent','crumb'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:m:s', time());
        ActionModel::find($id)->update($data);
        return redirect('/admin/action');
    }

    public function forceDelete($id)
    {
        ActionModel::find($id)->delete();
    }





    /**
     * ==========================
     * 一下是公用方法
     * ==========================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        if (!$data['style_class']) { $data['style_class'] = ''; }
        if (!$data['intro']) { $data['intro'] = ''; }
        $data = [
            'name'=> $data['name'],
            'intro'=> $data['intro'],
            'namespace'=> $data['namespace'],
            'controller_prefix'=> substr($data['controller_prefix'],0,-10),
            'url'=> $data['url'],
            'action'=> $data['action'],
            'style_class'=> $data['style_class'],
            'pid'=> $data['pid'],
        ];
        return $data;
    }

    /**
     * 得到父操作
     */
    public function parent($pid)
    {
        if ($pid) {        //获取上级操作名称
            $pname = ActionModel::where('id',$pid)->first()->name;
        } else {
            $pname = '0级操作';
        }
        $parent['id'] = $pid;
        $parent['name'] = $pname;
        return $parent;
    }

    /**
     *查询方法
     */
//    public function query(){}
}
