<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductAttrModel;
//use App\Models\UserModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * 会员后台 在线动画 属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '动画属性';
        $this->lists['func']['url'] = 'productattr';
        $this->lists['create']['name'] = '添加属性';
        $this->model = new ProductAttrModel();
    }

    public function index($productid = 1)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $productModel = ProductModel::find($productid);
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'pname'=> isset($productModel) ? $productModel->name : '',
            'prefix_url'=> '/member/productattr',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    public function trash($productid = 1)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $productModel = ProductModel::find($productid);
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'pname'=> isset($productModel) ? $productModel->name : '',
            'prefix_url'=> '/member/productattr/trash',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    /**
     * 查询方法
     */
    public function query($del=0,$productid)
    {
        return ProductAttrModel::where('del',$del)
                    ->where('productid',$productid)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }
}