<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\ActionModel;

class ActionController extends BaseController
{
    /**
     * 权限管理
     */

    public function __construct()
    {
        $this->model = new ActionModel();
        $this->crumb['']['name'] = '权限列表';
        $this->crumb['category']['name'] = '权限管理';
        $this->crumb['category']['url'] = 'action';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> ActionModel::paginate($this->limit),
            'prefix_url'=> '/admin/action',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.action.index', $result);
    }

    public function create($pid=0)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'parent'=> $this->parent($pid),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.action.create', $result);
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
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> ActionModel::find($id),
            'crumb'=> $this->crumb,
        ];
        return view('admin.action.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'pactions'=> ActionModel::where('pid',0)->get(),
            'parent'=> $this->parent($id),
            'data'=> ActionModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.action.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:m:s', time());
        ActionModel::where('id',$id)->update($data);
        return redirect('/admin/action');
    }

    public function forceDelete($id)
    {
        ActionModel::where('id',$id)->delete();
        return redirect('/admin/action');
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
