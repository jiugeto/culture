<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
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
            'name'=> '租赁管理',
            'url'=> 'entertain',
        ],
    ];

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '娱乐列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/entertain',
        ];
        return view('admin.entertain.index', $result);
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '娱乐详情';
        $crumb['function']['url'] = 'entertain/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> EntertainModel::find($id),
        ];
        return view('admin.entertain.show', $result);
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
        return EntertainModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}