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

    public function store(){}

    public function edit(){}

    public function update(){}





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
        $productAttr = [
            'name'=> $request->name,
            'layerid'=> $request->layerid,
            'val'=> $request->val,
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
}