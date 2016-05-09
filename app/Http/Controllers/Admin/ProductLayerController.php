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
            'prefix_url'=> '/admin/productlayer',
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
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ProductLayerModel::create($data);
        return redirect('/admin/productlayer');
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
        return redirect('/admin/productlayer');
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
        $data = $request->all();
        $val = '';
        for ($i=1;$i<count(explode('|',$request->per))+1;++$i) {
            $valName = 'val'.$i;
            if ($data[$valName]=='') { echo "<script>alert('动画属性值不能空！');history.go(-1);</script>";exit; }
            if (substr($data[$valName],-1,1)!='|') { $data[$valName] = $data[$valName].'|'; }
            if (substr($request->field,-1,1)!='|') { $request->field = $request->field.'|'; }
            $count = count(explode('|',$request->field));
            if (count(explode('|',$data[$valName])) != $count) {
                echo "<script>alert('每个动画关键帧的值数量与字段数量必须一致！');history.go(-1);</script>";exit;
            }
            $val .= $data[$valName];
        }
        $val = substr($val,-1,1)!='|'?$val.'|':$val;
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
        return ProductLayerModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
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
//        $data->vals = $data->value?unserialize($data->value):[];
        $data->vals = $data->value?explode('|',$data->value):[];
        return $data;
    }
}