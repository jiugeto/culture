<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 系统后台设计管理
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
            'name'=> '设计管理',
            'url'=> 'design',
        ],
    ];

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '设计列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/design',
        ];
        return view('admin.design.index', $result);
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '设计详情';
        $crumb['function']['url'] = 'design/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> DesignModel::find($id),
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