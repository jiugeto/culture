<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\RentModel;

class RentController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '租赁列表';
        $this->crumb['category']['name'] = '租赁管理';
        $this->crumb['category']['url'] = 'rent';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/rent',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'data'=> RentModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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