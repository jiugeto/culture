<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company\ComModuleModel;
use App\Models\PicModel;
use Illuminate\Http\Request;
use App\Models\Company\ComFuncModel;

class ComFuncController extends BaseController
{
    /**
     * 系统后台企业模块 Company Module
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFuncModel();
        $this->crumb['']['name'] = '企业功能列表';
        $this->crumb['category']['name'] = '企业功能管理';
        $this->crumb['category']['url'] = 'comfunc';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/comfunc',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunc.index', $result);
    }

    public function create()
    {
//        //记录数限制
//        if (count(ComFuncModel::all())>$this->firmNum-1) {
//            echo "<script>alert('已满".$this->firmNum."条记录！');history.go(-1);</script>";exit;
//        }
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'modules'=> ComModuleModel::all(),
            'pics'=> PicModel::all(),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunc.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ComFuncModel::create($data);
        return redirect('/admin/comfunc');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'modules'=> ComModuleModel::all(),
            'pics'=> PicModel::all(),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunc.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/admin/comfunc');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'modules'=> ComModuleModel::all(),
            'pics'=> PicModel::all(),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunc.show', $result);
    }

    public function forceDelete($id)
    {
        ComFuncModel::where('id',$id)->delete();
        return redirect('/admin/comfunc');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容必填！');history.go(-1);</script>";exit; }
        if ($request->small && mb_substr($request->small,-1,1,'utf-8')!='|') { $request->small = $request->small.'|'; }
        $data = [
            'name'=> $request->name,
            'type'=> $request->type,
            'genre'=> $request->genre,
            'module_id'=> $request->module_id,
            'pic_id'=> $request->pic_id?$request->pic_id:0,
            'intro'=> $request->intro,
            'small'=> $request->small,
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
        return ComFuncModel::orderBy('id','desc')->paginate($this->limit);
    }
}