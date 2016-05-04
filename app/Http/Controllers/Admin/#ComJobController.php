<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComJobModel;

class ComJobController extends BaseController
{
    /**
     * 企业招聘管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComJobModel();
        $this->crumb['']['name'] = '企业招聘列表';
        $this->crumb['category']['name'] = '企业招聘管理';
        $this->crumb['category']['url'] = 'comjob';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/comjob',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.job.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/admin/comjob/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.job.index', $result);
    }

    public function create()
    {
        //记录数限制
        if (count(ComJobModel::all())>$this->comJobNum-1) {
            echo "<script>alert('已满".$this->comJobNum."条记录！');history.go(-1);</script>";exit;
        }
        //获取部分字段
        $jobModel = ComJobModel::orderBy('id','asc')->first();;
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'data'=> isset($jobModel)?$jobModel:'',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.job.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComJobModel::create($data);
        return redirect('/admin/comjob');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComJobModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.job.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComJobModel::where('id',$id)->update($data);
        //同时更改相关记录
        $jobModel = ComJobModel::find($id);
        ComJobModel::where('cid',$jobModel->cid)
            ->update(['name'=>$jobModel->name, 'intro'=>$jobModel->intro]);
        return redirect('/admin/comjob');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComJobModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.job.show', $result);
    }

    public function destroy($id)
    {
        ComJobModel::where('id',$id)->update([['del'=> 1]]);
        return redirect('/admin/comjob');
    }

    public function restore($id)
    {
        ComJobModel::where('id',$id)->update([['del'=> 0]]);
        return redirect('/admin/comjob/trash');
    }

    public function forceDelete($id)
    {
        ComJobModel::where('id',$id)->delete();
        return redirect('/admin/comjob/trash');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->num) { echo "<script>alert('工作数量必填！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'job'=> $request->job,
            'num'=> $request->num,
            'require'=> $request->require,
            'sort'=> $request->sort,
            'istop'=> $request->istop,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del)
    {
        return ComJobModel::where('del',$del)
                    ->orderBy('sort','desc')
                    ->orderBy('sort2','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }
}