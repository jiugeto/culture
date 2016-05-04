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

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.job.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.job.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComJobModel::create($data);
        return redirect('/company/admin/job');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComJobModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.job.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComJobModel::where('id',$id)->update($data);
        //同时修改相关其他记录
        ComJobModel::where('cid',$this->cid)
            ->update(['name'=>$request->name, 'intro'=>$request->intro]);
        return redirect('/company/admin/job');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComJobModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.job.show', $result);
    }

    public function destroy($id)
    {
        ComJobModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/company/admin/job');
    }

    public function restore($id)
    {
        ComJobModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/company/admin/job/trash');
    }

    public function forceDelete($id)
    {
        ComJobModel::where('id',$id)->delete();
        return redirect('/company/admin/job/trash');
    }





    public function getData(Request $request)
    {
        $jobModel = ComJobModel::where('cid',$this->cid)->first();
        $data = [
            'name'=> $jobModel->name,
            'intro'=> $jobModel->intro,
            'cid'=> $this->cid,
            'job'=> $request->job,
            'num'=> $request->num,
            'require'=> $request->require,
            'istop2'=> $request->istop2,
            'sort2'=> $request->sort2,
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    public function query($del)
    {
        //判断该公司的招聘有无记录
        //假如没有。即可生成默认记录
        $jobModels = ComJobModel::where('cid',$this->cid)->get();
        $jobModels0 = ComJobModel::where('cid',0)->get();
        //有则补充记录
//        if (count($jobModels) && count($jobModels)<$this->comJobNum) {
        if (count($jobModels) && count($jobModels)<count($jobModels0)) {
            foreach ($jobModels0 as $key=>$jobModel) {
                if ($jobModels0[$key]->cid!=$this->cid) {
                    $data = [
                        'name'=> $jobModel->name,
                        'cid'=> $this->cid,
                        'intro'=> $jobModel->intro,
                        'job'=> $jobModel->job,
                        'num'=> $jobModel->num,
                        'require'=> $jobModel->require,
                        'created_at'=> date('Y-m-d H:i:s', time()),
                    ];
                    ComJobModel::create($data);
                }
            }
        }
        //无则生成一组记录
        if (!count($jobModels)) {
            foreach (ComJobModel::where('cid',0)->get() as $jobModel) {
                $data = [
                    'name'=> $jobModel->name,
                    'cid'=> $this->cid,
                    'intro'=> $jobModel->intro,
                    'job'=> $jobModel->job,
                    'num'=> $jobModel->num,
                    'require'=> $jobModel->require,
                    'created_at'=> date('Y-m-d H:i:s', time()),
                ];
                ComJobModel::create($data);
            }
        }

        return ComJobModel::where('del',$del)
                    ->where('cid',$this->cid)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }
}