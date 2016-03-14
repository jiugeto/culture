<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsModel;
use Illuminate\Http\Request;

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

    /**
     * 收集数据
     */
    public function getData(Request $request,$type=1,$id=null)
    {
        $data = $request->all();
        //uid暂且为10,uname暂且为''
        $uid = 0; $uname = '';
        $goods = [
            'name'=> $data['name'],
            'type'=> $type,
            'cate_id'=> $data['cate_id'],
            'intro'=> $data['intro'],
            'link_id'=> $data['link_id'],
            'uid'=> $uid,
            'uname'=> $uname,
        ];
        return $goods;
    }
}