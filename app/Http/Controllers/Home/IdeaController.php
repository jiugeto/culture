<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiIdea;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 前台创意管理
     */

    protected $curr = 'idea';

    public function __construct()
    {
        parent::__construct();
    }

    public function islogin()
    {
        if (!\Session::has('user.uid')) {
            echo "<script>alert('您还没有登录，请先登录！');window.location.href='/login';</script>";exit;
        }
    }

    public function index($cate=0)
    {
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'idea';
        $apiIdea = ApiIdea::index($this->limit,$pageCurr,0,$cate,2,0);
        if ($apiIdea['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiIdea['data']; $total = $apiIdea['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->list,
            'curr_menu' => $this->curr,
            'userid' => $this->userid,
            'cate' => $cate,
        ];
        return view('home.idea.index', $result);
    }

//    /**
//     * 浏览权限控制
//     */
//    public function show($id)
//    {
//        $this->islogin();
//        $data = IdeasModel::find($id);
//        if ($data->uid!=$this->userid) {
//            $create = ['ideaid'=>$id,'uid'=>$this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
//            IdeasReadModel::create($create);
//        }
//        //内容查看权限开关
//        $data->iscon = 0;
//        if ($data->genre==1) {
//            //供应分镜
//            $orderModel = OrderModel::where('buyer',$this->userid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        } elseif ($data->genre==2) {
//            //需求分镜
//            $orderModel = OrderModel::where('seller',$this->userid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        }
//        if (isset($orderModel) && $orderModel) {
//            if ($orderModel->status < 12) { $data->iscon = 1; }
//            elseif ($orderModel->status == 13) { $data->iscon = 2; }
//            elseif ($orderModel->status == 12) { $data->iscon = 3; }
//            $data->remarks = $orderModel->remarks;
//        }
//        $result = [
//            'data'=> $data,
//            'curr_menu'=> $this->curr,
//        ];
//        return view('home.idea.show', $result);
//    }

//    /**
//     * 点赞自增
//     */
//    public function click($id,$click)
//    {
//        $this->islogin();
//        if (!$click) {        //增加
//            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
//            IdeasClickModel::create($create);
//        } else {        //减少
//            IdeasClickModel::where('ideaid',$id)->delete();
//        }
//        return redirect('/idea');
//    }

//    /**
//     * 收藏自增
//     */
//    public function collect($id,$collect)
//    {
//        $this->islogin();
//        if (!$collect) {      //增加
//            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
//            IdeasCollectModel::create($create);
//        } else {        //减少
//            IdeasCollectModel::where('ideaid',$id)->delete();
//        }
//        return redirect('/idea');
//    }




    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiIdea = ApiIdea::getModel();
        return $apiIdea['code']==0 ? $apiIdea['model'] : [];
    }
}