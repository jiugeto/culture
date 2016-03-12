<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductModel;
//use App\Models\ProductAttrModel;

class ProductController extends BaseController
{
    /**
     * 会员后台在线视频动画产品管理
     */
    protected $menus;

    public function __construct()
    {
        $this->menus = $this->list;
        $this->menus['creation'] = '去创作';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'menus'=> $this->menus,
            'prefix_url'=> '/member/product',
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