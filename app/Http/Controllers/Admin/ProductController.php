<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    /**
     * 系统后台产品管理
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
            'name'=> '产品管理',
            'url'=> 'product',
        ],
    ];

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '内部产品列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'cssList'=> $this->model->cssList(),
            'jsList'=> $this->model->jsList(),
            'crumb'=> $crumb,
            'datas'=> $this->query(0),
            'prefix_url'=> '/admin/product',
        ];
        return view('admin.product.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '产品添加';
        $crumb['function']['url'] = 'product/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'cssList'=> $this->model->cssList(),
            'jsList'=> $this->model->jsList(),
        ];
        return view('admin.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        ProductModel::create($data);
        return redirect('/admin/product');
    }

    public function edit($id)
    {
        $data = ProductModel::find($id);
        $data->css = $this->model->getOneCss($data->css_id);
        $data->js = $this->model->getOneJs($data->js_id);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '产品修改';
        $crumb['function']['url'] = 'product/edit';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> $data,
        ];
        return view('admin.product.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        ProductModel::where('id',$id)->update($data);
        return redirect('/admin/product');
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '产品详情';
        $crumb['function']['url'] = 'product/show';
        $data = ProductModel::find($id);
        $data->css = $this->model->getOneCss($data->css_id);
        $data->js = $this->model->getOneJs($data->js_id);
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> $data,
        ];
        return view('admin.product.show', $result);
    }

    public function trash()
    {
        $result = [
            'actions'=> $this->actions(),
        ];
        return view('admin.product.trash', $result);
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
        $product = [
            'name'=> $data['name'],
            'uid'=> $data['uid'],
            'uname'=> $data['uname'],
            'css_id'=> $data['css_id'],
            'js_id'=> $data['js_id'],
        ];
        return $product;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $products = ProductModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        return $products;
    }
}