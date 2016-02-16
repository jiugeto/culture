<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttrModel;

class ProductAttrController extends BaseController
{
    /**
     * 系统后台内部产品属性管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '产品属性管理',
            'url'=> 'productattr',
        ],
    ];

    public function __construct()
    {
        $this->model = new ProductAttrModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '产品属性列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query(0),
            'prefix_url'=> '/admin/productattr',
        ];
        return view('admin.productAttr.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '产品属性添加';
        $crumb['function']['url'] = 'productattr/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'types'=> $this->model->getTypes(),
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