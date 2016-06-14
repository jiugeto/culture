<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/actor',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ActorModel::create($data);
        return redirect('/admin/actor');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ActorModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('y-m-d H:i:s', time());
        ActorModel::where('id',$id)->update($data);
        return redirect('/admin/actor');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ActorModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.actor.show', $result);
    }

    public function destroy($id)
    {
        ActorModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/actor');
    }

    public function restore($id)
    {
        ActorModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/admin/actor');
    }

    public function forceDelete($id)
    {
        ActorModel::where('id',$id)->delete();
        return redirect('/admin/actor');
    }




    public function query()
    {
        return ActorModel::where('del',0)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }

    public function getData(Request $request)
    {
        if (!$request->hobby) { echo "<script>alert('请选择兴趣！');history.go(-1);</script>";exit; }
        return array(
            'name'=> $request->name,
            'sex'=> $request->sex,
            'realname'=> $request->realname,
            'origin'=> $request->origin,
            'education'=> $request->education,
            'school'=> $request->school,
            'hobby'=> implode(',',$request->hobby),
            'height'=> $request->height,
        );
    }
}