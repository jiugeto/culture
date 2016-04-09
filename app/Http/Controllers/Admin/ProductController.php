<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends BaseController
{
    /**
     * 系统后台产品管理
     */

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->crumb['']['name'] = '产品列表';
        $this->crumb['category']['name'] = '产品管理';
        $this->crumb['category']['url'] = 'product';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'cssList'=> $this->model->cssList(),
            'jsList'=> $this->model->jsList(),
            'datas'=> $this->query(0),
            'prefix_url'=> '/admin/product',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'cssList'=> $this->model->cssList(),
            'jsList'=> $this->model->jsList(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $data = ProductModel::find($id);
        $data->css = $this->model->getOneCss($data->css_id);
        $data->js = $this->model->getOneJs($data->js_id);
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.show', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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