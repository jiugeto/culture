<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiGoods;
use Illuminate\Http\Request;
use Session;

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
        $this->uid = Session::has('user.uid') ? Session::get('user.uid') : 0;
    }

    public function index($ptype=1)
    {
        if ($ptype==1) {
            $view = 'index';
            $prefix_url = DOMAIN.'product';
        } elseif ($ptype==2) {
            $view = 'cus';
            $prefix_url = DOMAIN.'product/s/2';
        }
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,0,$ptype,0,0,2,0,0);
        if ($apiGoods['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiGoods['data']; $total = $apiGoods['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'lists' => $this->list,
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'ppts' => $this->ppts(9),
            'recommends' => $this->queryR(),
            'newests' => $this->queryNew(),
            'comNewests' => $this->queryNewType(4),
            'pNewests' => $this->queryNewType(2),
            'xuanchuans' => $this->getGoodsByCate(5,5),    //宣传片
            'curr_menu' => $this->curr,
//            'model'=> $this->getModel(),
            'ptype' => $ptype,
        ];
        return view('home.product.'.$view, $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '详情';
        $apiGoods = ApiGoods::show($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $apiGoods['code']==0 ? $apiGoods['data'] : [],
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $apiGoods['code']==0 ? $apiGoods['data']['uid'] : 0,
        ];
        return view('home.product.show', $result);
    }

//    /**
//     * 插入新增片源
//     */
//    public function insertProCus(Request $request)
//    {
//        if (!$request->uid || !$request->name || !$request->intro) {
//            echo "<script>alert('片源、需求方或描述有误！');history.go(-1);</script>";exit;
//        }
//        $data = [
//            'name'=> $request->name,
//            'intro'=> $request->intro,
//            'uid'=> $request->uid,
//            'money1'=> $request->money,
//            'created_at'=> time(),
//        ];
//        dd($request->all());
//        GoodsCusModel::create($data);
//        return redirect(DOMAIN.'product/s/2');
//    }

//    /**
//     * 插入新的片源申请
//     */
//    public function insertCus(Request $request)
//    {
//        if (!$request->cus_id || !$request->supply || !$request->time) {
//            echo "<script>alert('片源、申请方或周期有误！');history.go(-1);</script>";exit;
//        }
//        if (!preg_match('/^(https?:\/\/)?[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$/',$request->link)) {
//            echo "<script>alert('外链格式不对！');history.go(-1);</script>";exit;
//        }
//        $data = [
//            'cus_id'=> $request->cus_id,
//            'uid'=> $request->supply,
//            'link'=> $request->link,
//            'intro'=> $request->intro,
//            'money'=> $request->money,
//            'makeTime'=> $request->time,
//            'created_at'=> time(),
//        ];
//        dd($data);
//        GoodsCusUserModel::create($data);
//        return redirect(DOMAIN.'product/s/2');
//    }

//    /**
//     * 供应方发布的样片预览
//     */
//    public function video($id,$videoid)
//    {
//        $data = GoodsModel::find($id);
//        $result = [
//            'data'=> $data,
//            'video'=> VideoModel::find($videoid),
//            'uid'=> $this->uid,
//            'videoName'=> $data->name,
//        ];
//        return view('layout.videoPre', $result);
//    }

//    /**
//     * 设置点击量
//     */
//    public function setClick($id,$num)
//    {
//        if ($num==1) {
//            //增加点击量
//            GoodsModel::where('id',$id)->increment('click',1);
//        } elseif (in_array($num,[2,3])) {
//            //用户点击
//            $arr = array('gid'=> $id, 'uid'=> $this->uid, 'created_at'=> time());
//            GoodsClickModel::create($arr);
//        } elseif ($num==3) {
//            //用户喜欢
//            $arr = array('gid'=> $id, 'uid'=> $this->uid, 'created_at'=> time());
//            GoodsClickModel::create($arr);
//        }
//        return redirect(DOMAIN.'product/'.$id);
//    }

//    /**
//     * 点击量，象征性自增
//     */
//    public function click($id)
//    {
//        GoodsModel::where('id',$id)->increment('click', 1);
//        return redirect(DOMAIN.'product');
//    }

//    /**
//     * 点击量，每个会员一次
//     */
//    public function userClick($id)
//    {
//        if (!\Session::has('user.uid')) { return redirect('/login'); }
//        $userid = \Session::get('user.uid');
//        $arr = array('gid'=> $id ,'uid'=> $userid);
//        $userClick = GoodsClickModel::where($arr)->first();
//        if ($userClick) {
//            GoodsClickModel::where($arr)->delete();
//        } else {
//            $arr['created_at'] = time();
//            GoodsClickModel::create($arr);
//        }
//        return redirect(DOMAIN.'product');
//    }

//    /**
//     * 喜欢量，每个会员一次
//     */
//    public function userLike($id)
//    {
//        if (!\Session::has('user.uid')) { return redirect('/login'); }
//        $userid = \Session::get('user.uid');
//        $arr = array('gid'=> $id ,'uid'=> $userid);
//        $userLike = GoodsLikeModel::where($arr)->first();
//        if ($userLike) {
//            GoodsLikeModel::where($arr)->delete();
//        } else {
//            $arr['created_at'] = time();
//            GoodsLikeModel::create($arr);
//        }
//        return redirect(DOMAIN.'product');
//    }

//    /**
//     * 设定它一周以内的为最新的
//     */
//    public function setNew()
//    {
//        //一周以内为最新
//        //一周以外非最新
//    }






    /**
     * 推荐样片
     */
    public function queryR()
    {
        $apiGoods = ApiGoods::index($this->limit,1,0,0,0,0,2,1,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 最新样片
     */
    public function queryNew()
    {
        $apiGoods = ApiGoods::index($this->limit,1,0,0,0,0,2,0,1);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 最新样片：公司/设计师
     */
    public function queryNewType($type)
    {
        $apiGoods = ApiGoods::index($this->limit,1,0,$type,0,0,2,0,1);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 通过 category 获取数据
     */
    public function getGoodsByCate($cate,$limit)
    {
        $apiGoods = ApiGoods::index($limit,1,0,0,$cate,0,2,0,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    public function ppts($limit)
    {
        //adplace==1，前台样片的横幅幻灯片，limit==9
        $apiAd = ApiAd::index($limit,1,0,1,0,0,1,1);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    public function getModel()
    {
        $apiGoods = ApiGoods::getModel();
        return $apiGoods['code']==0 ? $apiGoods['model'] : [];
    }
}