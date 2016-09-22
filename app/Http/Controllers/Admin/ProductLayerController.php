<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductLayerModel;
use Illuminate\Http\Request;

class ProductLayerController extends BaseController
{
    /**
     * 系统后台 内部产品动画层级管理
     */

    protected $attrModel;
    protected $prefix_dh = 'dh_';     //动画名称前缀 dh->donghua

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '动画设置列表';
        $this->crumb['category']['name'] = '动画设置';
        $this->crumb['category']['url'] = 'proLayer';
        $this->model = new ProductLayerModel();
        $this->attrModel = new ProductAttrModel();
    }

    public function create($attrid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'attr'=> ProductAttrModel::find($attrid),
        ];
       return view('admin.proLayer.create', $result);
    }

    public function store(Request $request,$attrid)
    {
        $data = $this->getData($request);
        $data['a_name'] = $this->prefix_dh.$attrid.'_'.rand(0,10000);
        $data['attrid'] = $attrid;
        $data['created_at'] = time();
        ProductLayerModel::create($data);
        $productid = $this->getAttrIdByProductId($attrid);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    public function edit($attrid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductLayerModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'attr'=> ProductAttrModel::find($attrid),
        ];
        return view('admin.proLayer.edit', $result);
    }

    public function update(Request $request,$attrid,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductLayerModel::where('id',$id)->update($data);
        $productid = $this->getAttrIdByProductId($attrid);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    public function show($attrid,$id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductLayerModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.proLayer.show', $result);
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
        $data = [
            'name'=> $request->name,
            'timelong'=> $request->timelong,
            'func'=> $request->func,
            'delay'=> $request->delay,
        ];
        return $data;
    }

    /**
     * 通过 attrid 得到 productid
     */
    public function getAttrIdByProductId($attrid)
    {
        $attrModel = ProductAttrModel::find($attrid);
        return $attrModel ? $attrModel->productid : 0;
    }
}