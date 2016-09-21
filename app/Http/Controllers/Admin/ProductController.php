<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 系统后台产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '产品列表';
        $this->crumb['category']['name'] = '产品管理';
        $this->crumb['category']['url'] = 'product';
        $this->model = new ProductModel();
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(0),
            'prefix_url'=> DOMAIN.'admin/product',
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
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductModel::create($data);

        //插入搜索表
        $productModel = ProductModel::where($data)->first();
        \App\Models\Home\SearchModel::change($productModel,1,'create');

        return redirect(DOMAIN.'admin/product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductModel::where('id',$id)->update($data);

        //更新搜索表
        $productModel = ProductModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($productModel,1,'update');

        return redirect(DOMAIN.'admin/product');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.show', $result);
    }

//    public function destroy($id)
//    {
//        ProductModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'admin/product');
//    }
//
//    public function restore($id)
//    {
//        ProductModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'admin/product/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        ProductModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'admin/product/trash');
//    }





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
        $product = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'istop'=> $request->istop,
            'isshow'=> $request->isshow,
        ];
        return $product;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas = ProductModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}