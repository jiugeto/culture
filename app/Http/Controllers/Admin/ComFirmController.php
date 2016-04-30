<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComFirmModel;

class ComFirmController extends BaseController
{
    /**
     * 系统后台企业服务 company firm
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFirmModel();
        $this->crumb['']['name'] = '企业服务列表';
        $this->crumb['category']['name'] = '企业服务管理';
        $this->crumb['category']['url'] = 'comfirm';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/comfirm',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfirm.index', $result);
    }

    public function create()
    {
        //记录数限制
        if (count(ComFirmModel::all())>$this->firmNum-1) {
            echo "<script>alert('已满".$this->firmNum."条记录！');history.go(-1);</script>";exit;
        }
        //获取部分字段
        $firmModel = ComFirmModel::orderBy('id','asc')->first();;
        if ($firmModel) { $name = $firmModel->name; $intro = $firmModel->intro; }
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'name'=> isset($name) ? $name : '',
            'intro'=> isset($intro) ? $intro : '',
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfirm.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFirmModel::create($data);
        return redirect('/admin/comfirm');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComFirmModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfirm.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFirmModel::where('id',$id)->update($data);
        return redirect('/admin/comfirm');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComFirmModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfirm.show', $result);
    }

    public function forceDelete($id)
    {
        ComFirmModel::where('id',$id)->delete();
        return redirect('/admin/comfirm');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容必填！');history.go(-1);</script>";exit; }
        if (!$request->detail) { echo "<script>alert('标题说明必填！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'title'=> $request->title,
            'small'=> $request->small,
            'pic_id'=> $request->pic_id?$request->pic_id:0,
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
        return ComFirmModel::paginate($this->limit);
    }
}