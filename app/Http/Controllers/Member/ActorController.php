<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\ActorModel;

class ActorController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '演员管理';
        $this->lists['func']['url'] = 'entertain';
        $this->lists['create']['name'] = '添加演员';
        $this->model = new ActorModel();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/actor',
            'lists'=> $this->lists,
            'curr_list'=> '',
        ];
        return view('member.actor.index', $result);
    }

    public function create()
    {
        $result = [
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr_list'=> 'create',
        ];
        return view('member.actor.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ActorModel::create($data);
        return redirect('/member/actor');
    }

    public function edit($id)
    {
        $result = [
            'data'=> ActorModel::find($id),
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr_list'=> 'edit',
        ];
        return view('member.actor.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ActorModel::where('id',$id)->update($data);
        return redirect('/member/actor');
    }

    public function show($id)
    {
        $result = [
            'data'=> ActorModel::find($id),
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr_list'=> 'show',
        ];
        return view('member.actor.show', $result);
    }

    public function destroy($id)
    {
        ActorModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/actor');
    }

    public function restore($id)
    {
        ActorModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/actor/trash');
    }

    public function forceDelete($id)
    {
        ActorModel::where('id',$id)->delete();
        return redirect('/member/actor/trash');
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
        $entertain = [
            'name'=> $request->name,
            'sex'=> $request->sex,
            'realname'=> $request->realname,
            'origin'=> $request->origin,
            'education'=> $request->education,
            'school'=> $request->school,
            'hobby'=> $request->hobby,
            'job'=> $request->job,
            'area'=> 0,
            'height'=> $request->height,
        ];
        return $entertain;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas =  ActorModel::orderBy('id','desc')->paginate($this->limit);
        return $datas;
    }
}