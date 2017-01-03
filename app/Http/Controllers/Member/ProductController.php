<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiOnline\ApiProduct;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 会员后台在线视频动画产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '在线动画';
        $this->lists['func']['url'] = 'product';
        $this->lists['create']['name'] = '添加动画';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/product';
        $result = [
            'datas'=> $this->query($pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.index', $result);
    }

//    public function create()
//    {
//        $curr['name'] = $this->lists['create']['name'];
//        $curr['url'] = $this->lists['create']['url'];
//        $result = [
//            'model'=> $this->getModel(),
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.product.create', $result);
//    }
//
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

        return redirect(DOMAIN.'member/product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $rst = ApiProduct::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiProduct::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }

//        //更新搜索表
//        $productModel = ProductModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($productModel,1,'update');

        return redirect(DOMAIN.'member/product');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $rst = ApiProduct::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'cate'=> $request->cate,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($pageCurr,$prefix_url)
    {
//        $datas = ProductModel::where('isshow',2)
//            ->orderBy('id','desc')
//            ->paginate($this->limit);
//        $datas->limit = $this->limit;
        $rst = ApiProduct::getProductsList($this->limit,$pageCurr,0,0,2);
        $datas = $rst['code']==0?$rst['data']:[];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $model = ApiProduct::getModel();
        return $model['code']==0 ? $model['model'] : [];
    }
}