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
        $data = $request->all();
        //uid暂且为10,uname暂且为''
        $uid = 0; $uname = '';
        $goods = [
            'name'=> $data['name'],
            'type'=> $type,
            'intro'=> $data['intro'],
            'title'=> $data['title'],
            'pic_id'=> $data['pic_id'],
            'video_id'=> $data['video_id'],
            'uid'=> $uid,
            'uname'=> $uname,
        ];
        return $goods;
    }
}