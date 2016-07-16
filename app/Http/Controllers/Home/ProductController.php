<?php
namespace App\Http\Controllers\Home;

use App\Models\GoodsClickModel;
use App\Models\GoodsLikeModel;
use App\Models\GoodsModel;
use App\Models\UserParamsModel;
use App\Models\VideoModel;

class ProductController extends BaseController
{
    /**
     * 网站首页产品样片
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new GoodsModel();
    }

    public function index()
    {
        $result = [
            'recommends'=> $this->queryR(),
//            'newests'=> $this->queryN(),
            'datas'=> $this->query(),
            'curr_menu'=> 'product',
            'model'=> $this->model,
        ];
        return view('home.product.index', $result);
    }

//    public function show($id)
//    {
//        return view('home.product.show');
//    }

    public function video($id,$videoid)
    {
        $result = [
            'data'=> GoodsModel::find($id),
            'video'=> VideoModel::find($videoid),
            'uid'=> \Session::has('user.uid') ? \Session::get('user.uid') : 0,
        ];
        return view('layout.videoPre', $result);
    }

    /**
     * 点击量，象征性自增
     */
    public function click($id)
    {
        GoodsModel::where('id',$id)->increment('votes', 1);
        return redirect('/product');
    }

    /**
     * 点击量，每个会员一次
     */
    public function userClick($id)
    {
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $userid = \Session::get('user.uid');
        $arr = array('gid'=> $id ,'uid'=> $userid);
        $userClick = GoodsClickModel::where($arr)->first();
        if ($userClick) {
            GoodsClickModel::where($arr)->delete();
        } else {
            $arr['created_at'] = time();
            GoodsClickModel::create($arr);
        }
        return redirect('/product');
    }

    /**
     * 喜欢量，每个会员一次
     */
    public function userLike($id)
    {
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $userid = \Session::get('user.uid');
        $arr = array('gid'=> $id ,'uid'=> $userid);
        $userLike = GoodsLikeModel::where($arr)->first();
        if ($userLike) {
            GoodsLikeModel::where($arr)->delete();
        } else {
            $arr['created_at'] = time();
            GoodsLikeModel::create($arr);
        }
        return redirect('/product');
    }

    /**
     * 设定它一周以内的为最新的
     */
    public function setNew()
    {
        //一周以内为最新
        //一周以外非最新
    }




    public function query()
    {
        return GoodsModel::where('isshow',1)
            ->where('isshow2',1)
            ->where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }

    /**
     * 推荐样片
     */
    public function queryR()
    {
        return GoodsModel::where('recommend',1)
            ->where('isshow',1)
            ->where('isshow2',1)
            ->where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
//            ->get();
    }

//    /**
//     * 最新样片
//     */
//    public function queryN()
//    {
//        return GoodsModel::where('newest',1)
//            ->where('isshow',1)
//            ->where('isshow2',1)
//            ->where('del',0)
//            ->orderBy('sort','desc')
//            ->orderBy('id','desc')
////            ->paginate($this->limit);
//            ->get();
//    }
}