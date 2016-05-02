<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComJobModel;
use Illuminate\Http\Request;

class JobController extends BaseController
{
    /**
     * 企业开展后台，招聘管理
     */

    protected $curr_url = 'job';

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '招聘编辑';
        $this->lists['func']['url'] = 'job';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.job.index', $result);
    }

    public function create($id)
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
            'id'=> $id,
        ];
        return view('company.admin.job.create', $result);
    }

    public function store(Request $request)
    {
        //取出值
        $jobModel = ComMainModel::find($request->id);
        $jobs = $jobModel->job?explode('|',$jobModel->job):[];
        $jobNums = $jobModel->job_num?explode('|',$jobModel->job_num):[];
        $jobRequires = $jobModel->job_require?explode('|',$jobModel->job_require):[];
        //修改值
        $index = $request->index;
        $jobs[] = $request->job;
        $jobNums[] = $request->num;
        $jobRequires[] = $request->require;
        //还原字符串，更新表
        $data = [
            'job'=> implode('|',$jobs),
            'job_num'=> implode('|',$jobNums),
            'job_require'=> implode('|',$jobRequires),
        ];
        ComMainModel::where('id',$request->id)->update($data);
        return redirect('/company/admin/job');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $arr = explode('-',$id); $index = $arr[1];
        $data = ComMainModel::find($arr[0]);
        $jobs = explode('|',$data->job);
        $jobNums = explode('|',$data->job_num);
        $jobRequires = explode('|',$data->job_require);
        $data->job = $jobs[$index];
        $data->num = $jobNums[$index];
        $data->require = $jobRequires[$index];
        $result = [
            'data'=> $data,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> $arr[1],
        ];
        return view('company.admin.job.edit', $result);
    }

    public function update(Request $request,$id)
    {
        //取出值
        $jobModel = ComMainModel::find($id);
        $jobs = explode('|',$jobModel->job);
        $jobNums = explode('|',$jobModel->job_num);
        $jobRequires = explode('|',$jobModel->job_require);
        //修改值
        $index = $request->index;
        $jobs[$index] = $request->job;
        $jobNums[$index] = $request->num;
        $jobRequires[$index] = $request->require;
        //还原字符串，更新表
        $data = [
            'job'=> implode('|',$jobs),
            'job_num'=> implode('|',$jobNums),
            'job_require'=> implode('|',$jobRequires),
        ];
        ComMainModel::where('id',$id)->update($data);
        return redirect('/company/admin/job');
    }

    public function del($id)
    {
        $arr = explode('-',$id); $index = $arr[1];
        $data = ComMainModel::find($arr[0]);
        $jobs = explode('|',$data->job);
        $jobNums = explode('|',$data->job_num);
        $jobRequires = explode('|',$data->job_require);
        unset($jobs[$index]); sort($jobs);
        unset($jobNums[$index]); sort($jobNums);
        unset($jobRequires[$index]); sort($jobRequires);
        $data = [
            'job'=> implode('|',$jobs),
            'job_num'=> implode('|',$jobNums),
            'job_require'=> implode('|',$jobRequires),
        ];
        ComMainModel::where('id',$id)->update($data);
        return redirect('/company/admin/job');
    }





    public function query($del)
    {
//        $jobModels = ComJobModel::where('del',$del)
//                    ->where('isshow',1)
//                    ->orderBy('sort','desc')
//                    ->orderBy('id','desc')
//                    ->paginate($this->limit);
        $jobModels = ComJobModel::where('cid',$this->cid)->get();
        //假如记录不足，则补充
        if (count($jobModels) && count($jobModels)<$th) {}
        //假如没有记录，则添加
    }
}