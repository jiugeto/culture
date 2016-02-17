<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '娱乐列表';
        $this->crumb['category']['name'] = '娱乐管理';
        $this->crumb['category']['url'] = 'entertain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/entertain',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'actions'=> $this->actions(),
            'data'=> EntertainModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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