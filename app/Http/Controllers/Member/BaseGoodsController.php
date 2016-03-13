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
    public function query($del=0,$type,$cate_id=0)
    {
        if ($cate_id) {
            $goods =  GoodsModel::where('del',$del)
                ->where('type',$type)
                ->where('cate_id',$cate_id)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $goods =  GoodsModel::where('del',$del)
                ->where('type',$type)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        foreach ($goods as $good) {
            $good->catename = '';
            if ($good->cate_id) {
                $good->catename = CategoryModel::find($good->cate_id)->name;
            }
        }
        return $goods;
    }

    /**
     * 收集数据
     */
    public function getData(Request $request,$type,$id=null)
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