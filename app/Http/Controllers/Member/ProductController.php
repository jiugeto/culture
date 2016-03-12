<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductModel;
use App\Models\ProductAttrModel;

class ProductController extends BaseController
{
    /**
     * 会员后台在线视频动画产品管理
     */

    public function index()
    {
        $datas = ProductModel::where('del',0)->paginate($this->limit);
        return view('member.product.index', compact('datas'));
    }
}