<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiOnline\ApiProduct;
use App\Api\ApiOnline\ApiTemp;
use App\Api\ApiUser\ApiUsers;
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
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/product';
        $apiProduct = ApiProduct::getProductsList($this->limit,$pageCurr,0,0,0);
        if ($apiProduct['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiProduct['data']; $total = $apiProduct['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'temps' => $this->getTemps(),
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
        $apiProduct = ApiProduct::show($id);
        if ($apiProduct['code']!=0) {
            echo "<script>alert('".$apiProduct['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiProduct['data'],
            'model'=> $this->getModel(),
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

    public function setShow($id,$isshow)
    {
        $rst = ApiProduct::setShow($id,$isshow);
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
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        return array(
            'name'      =>  $request->name,
            'tempid'    =>  $request->tempid,
            'intro'     =>  $request->intro,
            'uid'       =>  $apiUser['data']['id'],
            'uname'     =>  $request->uname,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiProduct::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 获取所有模板
     */
    public function getTemps()
    {
        $apiTemp = ApiTemp::getTempAll();
        return $apiTemp['code']==0 ? $apiTemp['data'] : [];
    }
}