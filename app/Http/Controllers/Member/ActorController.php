<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\StaffModel;

class ActorController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '艺人管理';
        $this->lists['func']['url'] = 'actor';
        $this->lists['create']['name'] = '添加艺人';
        $this->model = new StaffModel();
    }

    public function index($genre=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($genre,0),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/actor',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> 0,
        ];
        return view('member.actor.index', $result);
    }

    public function trash($genre=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($genre,1),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/actor/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> 0,
        ];
        return view('member.actor.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.actor.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        StaffModel::create($data);

        //插入搜索表
        $staffModel = StaffModel::where($data)->first();
        \App\Models\Home\SearchModel::change($staffModel,7,'create');

        return redirect(DOMAIN.'member/actor');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> StaffModel::find($id),
            'model'=> $this->model,
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.actor.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        StaffModel::where('id',$id)->update($data);

        //更新搜索表
        $staffModel = StaffModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($staffModel,7,'update');

        return redirect(DOMAIN.'member/actor');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> StaffModel::find($id),
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.actor.show', $result);
    }

    public function destroy($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/actor');
    }

    public function restore($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/actor/trash');
    }

    public function forceDelete($id)
    {
        StaffModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/actor/trash');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->hobby) { echo "<script>alert('请填写兴趣！');history.go(-1);</script>";exit; }
        $entertain = [
            'name'=> $request->name,
            'sex'=> $request->sex,
            'realname'=> $request->realname,
            'origin'=> $request->origin,
            'education'=> $request->education,
            'school'=> $request->school,
            'hobby'=> implode(',',$request->hobby),
//            'job'=> $request->job,
            'height'=> $request->height,
        ];
        return $entertain;
    }

    /**
     * 查询方法
     */
    public function query($genre,$del)
    {
        if ($genre) {
            $datas =  StaffModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas =  StaffModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}