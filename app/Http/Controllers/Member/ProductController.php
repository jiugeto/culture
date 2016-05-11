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
//        $this->lists['create']['name'] = '开始创作';
        $this->lists['create']['name'] = '添加产品';
        $this->model = new ProductModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/product',
            'curr_list'=> $curr,
        ];
        return view('member.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr_list'=> $curr,
        ];
        return view('member.product.create', $result);
    }


    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
    }
}