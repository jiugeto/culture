<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsModel;

class BaseGoodsController extends BaseController
{
    /**
     * goods 商品、货物，代表文化类商品
     * 产品基础控制器
     */

    /**
     * 查询方法
     */
    public function query($del=0,$type=0,$cate_id=0)
    {
        return GoodsModel::where('del',$del)
            ->where('type',$type)
            ->where('cate_id',$cate_id)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}