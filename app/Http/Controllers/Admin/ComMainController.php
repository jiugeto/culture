<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComMainModel;

class ComMainController extends BaseController
{
    /**
     * 系统后台企业主体 company main
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComMainModel();
        $this->crumb['']['name'] = '企业主体列表';
        $this->crumb['category']['name'] = '企业主体管理';
        $this->crumb['category']['url'] = 'commain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/commain',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commain.index', $result);
    }

    public function create()
    {
        if (count(ComMainModel::all())) { echo "<script>alert('已有默认记录！');history.go(-1);</script>";exit; }
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ComMainModel::create($data);
        return redirect(DOMAIN.'admin/commain');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComMainModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$id);
        $data['updated_at'] = time();
        ComMainModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/commain');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $data = ComMainModel::find($id);
        if ($data->job) { $data->jobs = explode('|',$data->job); }
        if ($data->job_require) { $data->jobRequires = explode('|',$data->job_require); }
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commain.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request,$id=null)
    {
        //判断处理工作岗位
//        if ((!$request->job && $request->job_require) || ($request->job && !$request->job_require)) {
//            echo "<script>alert('岗位和岗位要求必须同时填写，或者同时不填写！');history.go(-1);</script>";exit;
//        }
//        if ($request->job && $request->job_require && count(explode('|',$request->job))!=count(explode('|',$request->job_require))) {
//            echo "<script>alert('岗位数量必须对应岗位要求！');history.go(-1);</script>";exit;
//        }
        if ($request->job && (!$request->job_num || !$request->job_require)) {
            echo "<script>alert('岗位、岗位人数和岗位要求必须同时填写，或者同时不填写！');history.go(-1);</script>";exit;
        }
        if ($request->job) {
            $jobNUm = count(explode('|',$request->job));
            if (count(explode('|',$request->job_num))!=$jobNUm || count(explode('|',$request->job_require))!=$jobNUm) {
                echo "<script>alert('岗位、数量、要求的个数必须一致！');history.go(-1);</script>";exit;
            }
        }
        //判断logo
        $logo = '';     //给个默认值
        if ($id) { $logo = ComMainModel::find($id)->logo; }
        //图片上传
        if(!$logo && $request->hasFile('url_ori')){  //判断文件存在
            $data['url_ori'] = '';
            //验证图片大小
            foreach ($_FILES as $pic) {
                if ($pic['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert('对不起，你上传的文件大于5M，请重新选择');history.go(-1);</script>";exit;
                }
            }
            $file = $request->file('url_ori');  //获取文件
            $logo = \App\Tools::upload($file);
        }
        $data = [
            'title'=> $request->title,
            'keyword'=> $request->keyword,
            'description'=> $request->description,
            'logo'=> $logo,
            'job'=> $request->job,
            'job_require'=> $request->job_require,
            'job_num'=> $request->job_num,
            'sort'=> $request->sort,
            'istop'=> $request->istop,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas = ComMainModel::paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}