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
        parent::__construct();
        $this->lists['func']['name'] = '在线创作';
        $this->lists['func']['url'] = 'product';
        $this->lists['create']['name'] = '开始创作';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/product',
            'curr_list'=> '',
//            'menus'=> $this->menus,
        ];
        return view('member.product.index', $result);
    }

//    public function create()
//    {
//        return redirect('/online');
//    }


    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductModel::where('del',$del)
                ->paginate($this->limit);
    }
}