<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComInfoModel;

class ComInfoController extends BaseController
{
    /**
     * 系统后台企业信息 company infomation
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComInfoModel();
        $this->crumb['']['name'] = '企业信息列表';
        $this->crumb['category']['name'] = '企业信息管理';
        $this->crumb['category']['url'] = 'cominfo';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'types'=> $this->model['types'],
            'prefix_url'=> '/admin/cominfo',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.cominfo.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'types'=> $this->model['types'],
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.cominfo.create', $result);
    }

    public function store(Request $request)
    {
        $this->isinfo($request->type);
        $data = $this->getData($request);
        //图片id转换
        $pics = $this->getPic($request);
        $data['pic'] = $pics?implode('|',$pics):'';
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComInfoModel::create($data);
        return redirect('/admin/cominfo');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $data = ComInfoModel::find($id);
        $data->pics = $data->pic?explode('|',$data->pic):[];
        $data->picNum = $data->pic?count(explode('|',$data->pic)):1;
        $result = [
            'data'=> $data,
            'types'=> $this->model['types'],
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.cominfo.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $this->isinfo($request->type,$id);
        $data = $this->getData($request);
        //图片id转换
        $infoModel = ComInfoModel::find($id);
        $oldPics = $infoModel->pic?explode('|',$infoModel->pic):[];
        $newPics = $this->getPic($request);
        $pics = array_merge($oldPics,$newPics);
        $data['pic'] = $pics?implode('|',$pics):'';
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComInfoModel::where('id',$id)->update($data);
        return redirect('/admin/cominfo');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $data = ComInfoModel::find($id);
        $data->pics = $data->pic?explode('|',$data->pic):[];
        $result = [
            'data'=> $data,
            'types'=> $this->model['types'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.cominfo.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!isset($request->intro)) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'type'=> $request->type,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
        ];
        return $data;
    }

    /**
     * 收集图片
     */
    public function getPic(Request $request)
    {
        $data = $request->all();
        foreach ($data as $k=>$v) {
            if (substr($k,0,6)=='pic_id') { $pics[] = $v; }
        }
        return isset($pics) ? $pics : [];
    }

    public function isinfo($type,$id=null)
    {
        $msg = '';
        if (!$type) { echo "<script>alert('信息类型必选！');history.go(-1);</script>"; }
        elseif ($type==1) { $msg = '公司介绍'; }
        elseif ($type==2) { $msg = '资质荣誉'; }
        elseif ($type==3) { $msg = '历程'; }
        elseif ($type==4) { $msg = '公司新闻'; }
        elseif ($type==5) { $msg = '行业资讯'; }
        elseif ($type==6) { $msg = '团队'; }
        if (!$id) {
            if (ComInfoModel::where('type',$type)->first()) {
                echo "<script>alert('已有默认".$msg."记录！');history.go(-1);</script>";exit;
            }
        } else {
            $infoModel = ComInfoModel::find($id);
            if ($type!=$infoModel->type) {
                echo "<script>alert('已有默认".$msg."记录！');history.go(-1);</script>";exit;
            }
        }
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ComInfoModel::orderBy('sort','desc')->orderBy('id','desc')->paginate($this->limit);
    }
}