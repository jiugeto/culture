<?php
namespace App\Http\Controllers\Member;

use App\Models\Online\OrderProductModel;
use App\Models\Online\ProductModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;

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
//        $this->lists['create']['name'] = '开始创作';
        $this->lists['create']['name'] = '添加动画';
        $this->model = new ProductModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'member/product',
            'curr'=> $curr,
        ];
        return view('member.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductModel::create($data);

        //插入搜索表
        $productModel = ProductModel::where($data)->first();
        \App\Models\Home\SearchModel::change($productModel,1,'create');

        return redirect(DOMAIN.'member/product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ProductModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductModel::where('id',$id)->update($data);

        //更新搜索表
        $productModel = ProductModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($productModel,1,'update');

        return redirect(DOMAIN.'member/product');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ProductModel::find($id),
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
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'intro'=> $request->intro,
            'cate'=> $request->cate,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas = ProductModel::where('isshow',2)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}