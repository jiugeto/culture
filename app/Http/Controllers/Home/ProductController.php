<?php
namespace App\Http\Controllers\Home;

use App\Models\GoodsClickModel;
use App\Models\GoodsLikeModel;
use App\Models\GoodsModel;
use App\Models\UserParamsModel;
use App\Models\Base\VideoModel;

class ProductController extends BaseController
{
    /**
     * 网站首页产品样片
     */

    protected $curr = 'product';
    protected $uid;

    public function __construct()
    {
        parent::__construct();
        $this->model = new GoodsModel();
        $this->uid = \Session::has('user.uid') ? \Session::get('user.uid') : 0;
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
            'recommends'=> $this->queryR(),
//            'newests'=> $this->queryN(),
            'datas'=> $this->query(),
            'curr_menu'=> $this->curr,
            'model'=> $this->model,
        ];
        return view('home.product.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '详情';
        $data = GoodsModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $data->uid,
        ];
        return view('home.product.show', $result);
    }

    public function video($id,$videoid)
    {
        $result = [
            'data'=> GoodsModel::find($id),
            'video'=> VideoModel::find($videoid),
            'uid'=> $this->uid,
        ];
        return view('layout.videoPre', $result);
    }

    public function setClick($id,$num)
    {
        if ($num==1) {
            //增加点击量
            GoodsModel::where('id',$id)->increment('click',1);
        } elseif (in_array($num,[2,3])) {
            //用户点击
            $arr = array('gid'=> $id, 'uid'=> $this->uid, 'created_at'=> time());
            GoodsClickModel::create($arr);
        } elseif ($num==3) {
            //用户喜欢
            $arr = array('gid'=> $id, 'uid'=> $this->uid, 'created_at'=> time());
            GoodsClickModel::create($arr);
        }
        return redirect(DOMAIN.'product/'.$id);
    }

    /**
     * 点击量，象征性自增
     */
    public function click($id)
    {
        GoodsModel::where('id',$id)->increment('click', 1);
        return redirect(DOMAIN.'product');
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
        return redirect(DOMAIN.'product');
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
        return redirect(DOMAIN.'product');
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