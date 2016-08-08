<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\StaffModel;

class StaffController extends BaseController
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
        $this->model = new StaffModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/staff',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.staff.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.staff.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        StaffModel::create($data);
        return redirect('/member/staff');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> StaffModel::find($id),
            'educations'=> $this->model['educations'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.staff.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        StaffModel::where('id',$id)->update($data);
        return redirect('/member/staff');
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
        return view('member.staff.show', $result);
    }

    public function destroy($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/staff');
    }

    public function restore($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/staff/trash');
    }

    public function forceDelete($id)
    {
        StaffModel::where('id',$id)->delete();
        return redirect('/member/staff/trash');
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
        $datas =  StaffModel::orderBy('id','desc')->paginate($this->limit);
        return $datas;
    }
}