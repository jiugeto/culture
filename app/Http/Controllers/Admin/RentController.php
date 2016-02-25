<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\RentModel;

class RentController extends BaseController
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
            'url'=> 'rent',
        ],
    ];

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '租赁列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($del=0),
        ];
        return view('admin.rent.index', $result);
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '租赁详情';
        $crumb['function']['url'] = 'rent/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> RentModel::find($id),
        ];
        return view('admin.rent.show', $result);
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
        return RentModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}