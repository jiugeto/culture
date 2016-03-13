<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductModel;
//use App\Models\ProductAttrModel;

class ProductController extends BaseController
{
    /**
     * 会员后台在线视频动画产品管理
     */

    public function __construct()
    {
        $this->list['func']['name'] = '在线创作';
        $this->list['func']['url'] = 'product';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'menus'=> $this->list,
            'prefix_url'=> '/member/product',
            'curr'=> '',
        ];
        return view('member.product.index', $result);
    }


    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductModel::where('del',$del)
                ->paginate($this->limit);
    }
}