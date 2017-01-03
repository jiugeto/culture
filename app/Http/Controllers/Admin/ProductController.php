<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiOnline\ApiProduct;
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
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/product';
        $result = [
            'datas'=> $this->query($pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $rst = ApiProduct::getModel();
        if ($rst['code']!=0) {
            echo "<script>alert('获取有误！');history.go(-1);</script>";exit;
        }
        $result = [
            'model'=> $rst['model'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiProduct::add($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }

//        //插入搜索表
//        $productModel = ProductModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($productModel,1,'create');

        return redirect(DOMAIN.'admin/product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiProduct::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'model'=> $rst['model'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
//        $data['updated_at'] = time();
//        ProductModel::where('id',$id)->update($data);
//        $rst = ApiProduct::;

//        //更新搜索表
//        $productModel = ProductModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($productModel,1,'update');

        return redirect(DOMAIN.'admin/product');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiProduct::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.product.show', $result);
    }

    public function setIsShow($id,$isshow)
    {
        $rst = ApiProduct::isShow($id,$isshow);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/product');
    }

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
            'cate'=> $request->cate,
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
    public function query($pageCurr,$prefix_url)
    {
        $rst = ApiProduct::getProductsList($this->limit,$pageCurr);
        $datas = $rst['code']==0?$rst['data']:[];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }
}