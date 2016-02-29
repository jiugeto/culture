<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\MenusModel;

class MenusController extends BaseController
{
    /**
     * 权限管理
     */

    public function __construct()
    {
        $this->model = new MenusModel();
        $this->crumb['category']['name'] = '前台控制菜单';
        $this->crumb['category']['url'] = 'menus';
        $this->crumb['']['name'] = '前台菜单列表';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> MenusModel::paginate($this->limit),
            'prefix_url'=> '/admin/menus',
            'types'=> $this->model['types'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.menus.index', $result);
    }

    public function create($pid=0)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'types'=> $this->model['types'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.menus.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:m:s', time());
        MenusModel::create($data);
        return redirect('/admin/menus');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'datas'=> MenusModel::find($id),
            'crumb'=> $this->crumb,
        ];
        return view('admin.menus.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'pactions'=> MenusModel::where('pid',0)->get(),
            'data'=> MenusModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.menus.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:m:s', time());
        MenusModel::find($id)->update($data);
        return redirect('/admin/menus');
    }

    public function forceDelete($id)
    {
        MenusModel::find($id)->delete();
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
            'type'=> $data['type'],
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
            $pname = MenusModel::where('id',$pid)->first()->name;
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
