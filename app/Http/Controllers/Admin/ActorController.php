<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Models\ActorModel;

class ActorController extends BaseController
{
    /**
     * 系统后台演员管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ActorModel();
        $this->crumb['']['name'] = '演员列表';
        $this->crumb['category']['name'] = '演员管理';
        $this->crumb['category']['url'] = 'actor';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> ActorModel::orderBy('id','desc')->paginate($this->limit),
            'prefix_url'=> '/admin/actor',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ActorModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.show', $result);
    }

    public function forceDelete($id)
    {
        ActorModel::where('id',$id)->delete();
        return redirect('/admin/actor');
    }
}