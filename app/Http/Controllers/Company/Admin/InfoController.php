<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComInfoModel;
use Illuminate\Http\Request;

class InfoController extends BaseController
{
    /**
     * 企业后台 信息管理：资质、历程、新闻、资讯、团队
     */

    //信息类型：1公司介绍，2资质荣誉，3历程，4公司新闻，5行业咨询，6团队

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '公司信息';
        $this->lists['func']['url'] = 'info';
        $this->model = new ComInfoModel();
    }

    public function index($type=[2,3,4,5,6])
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($type),
            'type'=> is_array($type)?0:$type,
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.info.index', $result);
    }

    public function create($type=0)
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->model->pics(),
            'types'=> $this->model['types'],
            'type'=> $type,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.info.create', $result);
    }

    public function store(Request $request)
    {
        //做一下限制
        $infoModel = ComInfoModel::where(['cid'=>$this->cid,'type'=>$request->type])->get();
        if (count($infoModel)) { echo "<script>alert('已有相关记录！');history.go(-1);</script>";exit; }
        //获取值
        $data = $this->getData($request);
        //图片id转换
        $pics = $this->getPic($request);
        $data['pic'] = $pics?implode('|',$pics):'';
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComInfoModel::create($data);
        return redirect('/company/admin/info');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ComInfoModel::find($id);
        $data->pics = array(); $data->numPic = 1;
        if ($data->pic) {
            $data->pics = explode('|',$data->pic);
            $data->pics = array_filter($data->pics);
            $data->numPic = count($data->pics);
        }
        $result = [
            'data'=> $data,
            'pics'=> $this->model->pics(),
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.info.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        //图片id转换
        $infoModel = ComInfoModel::find($id);
        $oldPics = $infoModel->pic?explode('|',$infoModel->pic):[];
        $newPics = $this->getPic($request);
        $pics = $oldPics?array_merge($oldPics,$newPics):$newPics;
        $data['pic'] = $pics?implode('|',$pics):'';
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComInfoModel::where('id',$id)->update($data);
        return redirect('/company/admin/info');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = ComInfoModel::find($id);
        $data->pics = $data->pic?explode('|',$data->pic):[];
        $result = [
            'data'=> $data,
            'types'=> $this->model['types'],
            'pics'=> $this->model->pics(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.info.show', $result);
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $this->cid = 0;     //暂时0
        if (!$request->intro) { echo "<script>alert('内容必填！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'cid'=> $this->cid,
            'type'=> $request->type,
            'intro'=> $request->intro,
            'sort2'=> $request->sort2,
            'isshow2'=> $request->isshow2,
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
            if (substr($k,0,3)=='pic' && !in_array($v,['',0])) { $pics[] = $v; }
        }
        return isset($pics) ? $pics : [];
    }

    /**
     * 查询方法
     */
    public function query($type)
    {
        $this->cid = 0;     //假如默认0
        if (is_array($type)) {
            $datas = ComInfoModel::where('cid',$this->cid)
                ->whereIn('type',$type)
                ->orderBy('istop','desc')
                ->orderBy('sort2','desc')
                ->paginate($this->limit);
        } else {
            $datas = ComInfoModel::where('cid',$this->cid)
                ->where('type',$type)
                ->orderBy('istop','desc')
                ->orderBy('sort2','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}