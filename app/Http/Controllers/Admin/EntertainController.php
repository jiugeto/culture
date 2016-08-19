<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '娱乐列表';
        $this->crumb['category']['name'] = '娱乐管理';
        $this->crumb['category']['url'] = 'entertain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/entertain',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        EntertainModel::create($data);
        return view(DOMAIN.'admin/entertain');
    }

    public function edit($id)
    {
        $data = EntertainModel::find($id);
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        EntertainModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/entertain');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
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
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //uname 转为 uid
        $data['uid'] = 0;       //测试，暂为0
        $entertain = [
            'title'=> $data['title'],
            'content'=> $data['content'],
            'uid'=> $data['uid'],
        ];
        return $entertain;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = EntertainModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}