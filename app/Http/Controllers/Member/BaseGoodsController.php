<?php
namespace App\Http\Controllers\Member;

use App\Models\CategoryModel;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class BaseGoodsController extends BaseController
{
    /**
     * goods 商品、货物，代表文化类商品
     * 产品基础控制器
     */

    protected $cateModels;

    /**
     * 查询方法
     */
    public function query($del=0,$type)
    {
        $datas =  GoodsModel::where('del',$del)
            ->where('type',$type)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 收集数据
     */
    public function getData(Request $request,$type)
    {
        $goods = [
            'name'=> $request->name,
            'type'=> $type,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'title'=> $request->title,
            'pic_id'=> $request->pic_id,
            'video_id'=> $request->video_id,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
        ];
        return $goods;
    }
}