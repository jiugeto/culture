<?php

namespace App\Http\Controllers\Admin;

use App\Models\StaffModel;
use Illuminate\Http\Request;

class StaffController extends BaseController
{
    /**
     * 系统后台演员管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new StaffModel();
        $this->crumb['']['name'] = '员工列表';
        $this->crumb['category']['name'] = '员工管理';
        $this->crumb['category']['url'] = 'staff';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/staff',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.staff.index', $result);
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
        return view('admin.staff.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        StaffModel::create($data);
        return redirect('/admin/staff');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> StaffModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.staff.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        StaffModel::where('id',$id)->update($data);
        return redirect('/admin/staff');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> StaffModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.staff.show', $result);
    }

    public function destroy($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/staff');
    }

    public function restore($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/admin/staff');
    }

    public function forceDelete($id)
    {
        StaffModel::where('id',$id)->delete();
        return redirect('/admin/staff');
    }




    public function query()
    {
        return StaffModel::where('del',0)
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