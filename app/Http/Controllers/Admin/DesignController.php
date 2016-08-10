<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignPerController extends BaseController
{
    /**
     * 系统后台设计管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new DesignModel();
        $this->crumb['']['name'] = '设计列表';
        $this->crumb['category']['name'] = '设计管理';
        $this->crumb['category']['url'] = 'designPer';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/designPer',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.designPer.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/designPer/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.designPer.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'types'=> $this->model->types(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.designPer.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        DesignModel::create($data);
        return redirect('/admin/designPer');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'types'=> $this->model->types(),
            'data'=> DesignModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.designPer.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        DesignModel::where('id',$id)->update($data);
        return redirect('/admin/designPer');
    }

    public function show($id)
    {
        $data = DesignModel::find($id);
        $data->type_name = $this->model->getOneType($data->type_id);
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.show', $result);
    }





    /**
     * ===================
     * 以下是公用方法
     * ===================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //由用户名称得到用户ID
        if (!$data['uname']) { $data['uid'] = 0; }
        $design = [
            'name'=> $data['name'],
            'genre'=> $data['genre'],
            'type_id'=> $data['type_id'],
            'uid'=> $data['uid'],
            'intro'=> $data['intro'],
            'price'=> $data['price'],
        ];
        return $design;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return DesignModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}