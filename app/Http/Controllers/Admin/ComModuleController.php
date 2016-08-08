<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComModuleModel;

class ComModuleController extends BaseController
{
    /**
     * 系统后台企业模块 Company Module
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComModuleModel();
        $this->crumb['']['name'] = '企业模块列表';
        $this->crumb['category']['name'] = '企业模块管理';
        $this->crumb['category']['url'] = 'commodule';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/commodule',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commodule.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=>$this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commodule.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ComModuleModel::create($data);
        return redirect('/admin/commodule');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComModuleModel::find($id),
            'model'=>$this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commodule.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ComModuleModel::where('id',$id)->update($data);
        return redirect('/admin/commodule');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComModuleModel::find($id),
            'model'=>$this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commodule.show', $result);
    }

    public function forceDelete($id)
    {
        ComModuleModel::where('id',$id)->delete();
        return redirect('/admin/commodule');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容必填！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'genre'=> $request->genre,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ComModuleModel::orderBy('id','desc')->paginate($this->limit);
    }
}