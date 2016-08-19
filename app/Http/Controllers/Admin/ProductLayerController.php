<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductLayerModel;

class ProductLayerController extends BaseController
{
    /**
     * 系统后台 内部产品动画层级管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductLayerModel();
        $this->crumb['']['name'] = '产品动画列表';
        $this->crumb['category']['name'] = '产品动画';
        $this->crumb['category']['url'] = 'productlayer';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/productlayer',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productLayer.index', $result);
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
       return view('admin.productLayer.create', $result);
    }

    public function store(Request $request)
    {
        //动画名称判断
        $layerModel = ProductLayerModel::where('animation_name',$request->animation_name)->first();
        if ($layerModel) { echo "<script>alert('已有同名动画，请更改动画名称！');history.go(-1);</script>";exit; }
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductLayerModel::create($data);
        return redirect(DOMAIN.'admin/productlayer');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $this->getOne($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productLayer.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductLayerModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/productlayer');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $this->getOne($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productLayer.show', $result);
    }





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //动画属性值处理
        if (substr($request->field,-1,1)!='|') { $request->field = $request->field.'|'; }
        if (substr($request->per,-1,1)!='|') { $request->per = $request->per.'|'; }
        $data = $request->all();
        $val = '';
        for ($i=1;$i<count(explode('|',$request->per));++$i) {
            $valName = 'val'.$i;
            if ($data[$valName]=='') { echo "<script>alert('动画属性值不能空！');history.go(-1);</script>";exit; }
            //拼凑字符串
            if (substr($data[$valName],-1,1)!='|') { $data[$valName] = $data[$valName].'|'; }
            $data[$valName] = $data[$valName].',';
            $val .= $data[$valName];
        }
        //值判断
        $count = count(explode('|',$request->per));
//        dd($data,$val,$count,count(explode(',',$val)));
        if (count(explode(',',$val)) != $count) {
                echo "<script>alert('每个动画关键帧的值数量与字段数量必须一致！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'productid'=> $request->productid,
            'attrid'=> $request->attrid,
            'animation_name'=> $request->animation_name,
            'duration'=> $request->duration,
            'function'=> $request->function,
            'delay'=> $request->delay,
            'count'=> $request->count,
            'direction'=> $request->direction,
            'state'=> $request->state,
            'mode'=> $request->mode,
            'field'=> $request->field,
            'per'=> $request->per,
            'value'=> isset($val) ? $val : '',
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del)
    {
        $datas = ProductLayerModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 查询一条数据
     */
    public function getOne($id)
    {
        $data = ProductLayerModel::find($id);
        $data->fields = $data->field?explode('|',$data->field):[];
        $data->per_index = isset($data->pers)?count($data->pers):0;
        $data->pers = $data->per?explode('|',$data->per):[];
        $vals_per = $data->value?explode(',',$data->value):[];
        $data->vals = $vals_per?array_filter($vals_per):[];
        return $data;
    }
}