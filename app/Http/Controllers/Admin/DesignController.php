<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 系统后台设计管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '设计列表';
        $this->crumb['category']['name'] = '设计管理';
        $this->crumb['category']['url'] = 'design';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/design',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/design/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'actions'=> $this->actions(),
            'data'=> DesignModel::find($id),
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
     * 查询方法
     */
    public function query($del=0)
    {
        return DesignModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}