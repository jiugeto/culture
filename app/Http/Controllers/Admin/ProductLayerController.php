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
            'datas'=> $this->query(),
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
        dd($data);
        ProductLayerModel::create($data);
        return redirect('/admin/productlayer');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $th->,
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
        $data = $request->all();
        //动画属性值处理
        for ($i=1;$i<$this->proAttrNum+1;++$i) {
            $keyName = 'key'.$i;
            $valName = 'val'.$i;
            if ($data[$valName]) { $val[$keyName] = $data[$valName]; }
        }
        $productAttr = [
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
            'value'=> isset($val) ? serialize($val) : '',
            'intro'=> $request->intro,
        ];
        return $productAttr;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ProductLayerModel::paginate($this->limit);
    }

    /**
     * 查询一条数据
     */
    public function getOne($id){}
}