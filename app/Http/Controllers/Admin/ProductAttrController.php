<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttrModel;

class ProductAttrController extends BaseController
{
    /**
     * 系统后台内部产品属性管理
     */

    public function __construct()
    {
        $this->model = new ProductAttrModel();
        $this->crumb['']['name'] = '产品属性列表';
        $this->crumb['category']['name'] = '产品属性';
        $this->crumb['category']['url'] = 'productattr';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->query(0),
            'prefix_url'=> '/admin/productattr',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'actions'=> $this->actions(),
            'types'=> $this->model->getTypes(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.productAttr.create', $result);
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
        $data = $request->all();
        $productAttr = [
            'name'=> $data['name'],
            'type_id'=> $data['type_id'],
            'url'=> $data['url'],
            'intro'=> $data['intro'],
        ];
        return $productAttr;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $productAttrs = ProductAttrModel::paginate($this->limit);
        return $productAttrs;
    }
}