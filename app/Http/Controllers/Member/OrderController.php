<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiBusiness\ApiIdea;
use App\Api\ApiBusiness\ApiOrder;
use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class OrderController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        //面包屑处理
        $this->lists['func']['name'] = '订单管理';
        $this->lists['func']['url'] = 'order';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '订单列表';
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/order';
        $apiOrder = ApiOrder::index($this->limit,$pageCurr,2,0);
        if ($apiOrder['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiOrder['data']; $total = $apiOrder['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.order.index', $result);
    }

    /**
     * 前台下的订单，这里统一处理
     */
    public function store()
    {
        if (AjaxRequest::ajax()) {
            $genre = Input::get('genre');
            $fromid = Input::get('id');
            $uid = Input::get('uid');
            if (!$genre || !$uid) {
                echo json_encode(array('code'=>-2, 'message' =>'参数有误！！'));exit;
            }
            /**
             * 订单来源类型genre：
             * 1故事供应，2故事需求，3动画供应，4动画需求，5视频供应，6视频需求，
             * 7人员供应，8人员需求，9租赁供应，10租赁需求，11设计供应，12设计需求，
             */
            if (in_array($genre,[1,2])) {
                $apiData = ApiIdea::show($fromid);
            } else if (in_array($genre,[3,4,5,6])) {
                $apiData = ApiGoods::show($fromid);
            } else if (in_array($genre,[7,8])) {
                $apiData = ApiStaff::show($fromid);
            } else if (in_array($genre,[9,10])) {
                $apiData = ApiRent::show($fromid);
            } else if (in_array($genre,[11,12])) {
                $apiData = ApiDesign::show($fromid);
            } else {
                $apiData = ApiGoods::show($fromid);
            }
            //获取供求双方信息
            if (in_array($genre,[1,3,5,7,9,11])) {
                $buyer = $uid; $seller = $this->userid;
            } else {
                $seller = $uid; $buyer = $this->userid;
            }
            $apiBuyer = ApiUsers::getOneUser($buyer);
            $apiSeller = ApiUsers::getOneUser($seller);
            if ($apiBuyer['code']!=0 || $apiSeller['code']!=0) {
                echo json_encode(array('code'=>-3, 'message' =>'用户或商家信息错误！'));exit;
            }
            //假如已有类似订单
            $hasOrder = ApiOrder::getOneByGenre($genre,$fromid,$buyer,$seller);
            if ($hasOrder['code']==0) {
                echo json_encode(array('code'=>-4, 'message' =>'你已经申请此订单，不能重复申请！'));exit;
            }
            //插入订单表
            $data = [
                'name'      =>  $apiData['data']['name'],
                'genre'     =>  $genre,
                'fromid'    =>  $fromid,
                'seller'    =>  $seller,
                'sellerName'=>  $apiSeller['data']['username'],
                'buyer'     =>  $this->userid,
                'buyerName' =>  $apiBuyer['data']['username'],
            ];
            $apiOrder = ApiOrder::add($data);
            if ($apiOrder['code']!=0) {
                echo json_encode(array('code'=>-5, 'message' =>$apiOrder['msg']));exit;
            }
            echo json_encode(array('code'=>0, 'message' =>'操作成功！'));exit;
        }
        echo json_encode(array('code'=>-1, 'message' =>'非法操作!'));exit;
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiOrder = ApiOrder::show($id);
        if ($apiOrder['code']!=0) {
            echo "<script>alert('".$apiOrder['msg']."');history.go(-1);</script>";exit;
        }
        //联系方式
        if (in_array($apiOrder['data']['genre'],[1,3,5,7,9,11])) {
            $uid = $apiOrder['data']['seller'];
        } else {
            $uid = $apiOrder['data']['uid'];
        }
        $apiUser = ApiUsers::getOneUser($uid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiOrder['data'],
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'userid'=> $this->userid,
            'userInfo'=> $apiUser['data'],
        ];
        return view('member.order.show', $result);
    }

//    public function getUser($uid)
//    {
//        $userModel = UserModel::find($uid);
//        if (in_array($userModel->isuser,[2,4,5,6])) {
//            $userModel->company = CompanyModel::where('uid',$uid)->get();
//        } else {
//            $userModel->company = '';
//        }
//        return $userModel ? $userModel : '';
//    }

//    /**
//     * 确认、拒绝订单
//     */
//    public function tosure()
//    {
//        if (AjaxRequest::ajax()) {
//            $data = Input::all();
//            $updated_at = time();
//            if ($data['tosure']) {
//                OrderModel::where(['id'=>$data['id'],'status'=>1])->update(['status'=>2,'updated_at'=>$updated_at]);
//            } else {
//                if (!$data['remarks']) {
//                    echo json_encode(array('code'=>-2,'message'=>'拒绝理由必填！'));exit;
//                }
//                $update = array('status'=>3,'remarks'=>$data['remarks'],'updated_at'=>$updated_at);
//                OrderModel::where(['id'=>$data['id'],'status'=>1])->update($update);
//            }
//            echo json_encode(array('code'=>0,'message'=>'操作成功！'));exit;
//        }
//        echo json_encode(array('code'=>-1,'message'=>'参数有误！'));exit;
//    }

//    /**
//     * 确认支付宝是否打款
//     */
//    public function setPay()
//    {
//        if (AjaxRequest::ajax()) {
//            $data = Input::all();
//
//            //插入支付宝数据
//            $pay = [
//                'genre'=> 1,    //1订单表，2售后，3创作订单
//                'order_id'=> $data['order_id'],
//                'money'=> $data['money'],
//                'created_at'=> time(),
//            ];
//            PayModel::create($pay);
//
//            //更新订单表对应记录
//            $orderModel = OrderModel::find($data['order_id']);
//            if (!in_array($orderModel->genre,[5,6])) {
//                OrderModel::where('id',$data['order_id'])
//                    ->where('status',3)
//                    ->update(['status'=>5, 'updated_at'=>time()]);
//            } else {
//                OrderModel::where('id',$data['order_id'])
//                    ->where('status',3)
//                    ->update(['status'=>4, 'updated_at'=>time()]);
//            }
//            echo json_encode(array('code'=>0,'message'=>'操作成功！'));exit;
//        }
//        echo json_encode(array('code'=>-1,'message'=>'参数有误！'));exit;
//    }

//    /**
//     * 设置创意、分镜状态：6办理,、7收到、12成功、13失败
//     */
//    public function setStatus($id,$status)
//    {
//        $orderModel = OrderModel::find($id);
//        if ($orderModel->genre <= 4) {
//            if (in_array($status,[4,5])) { $s = 6; }
//            elseif ($status==6) { $s = 7; }
//            elseif ($status==7) { $s = 12; }
//            elseif ($status==13) { $s = 13; }
//        }
//        OrderModel::where('id',$id)->update(['status'=> $s]);
//        return redirect(DOMAIN.'member/order/'.$id);
//    }

//    /**
//     * 确认支付宝打款完毕，设置订单办理状态
//     */
//    public function setOrderStatus($id,$payStatus)
//    {
//        //订单支付状态：pay表中，订单类型表示，(1,2,3,4)为视频订单专用，其他订单用0表示
//        if ($payStatus==0) {
//            OrderModel::where('id',$id)->update(['status'=>6 ,'updated_at'=>time()]);
//        } elseif ($payStatus==1) {
//            OrderModel::where('id',$id)->update(['status'=>5 ,'updated_at'=>time()]);
//        } elseif ($payStatus==2) {
//            OrderModel::where('id',$id)->update(['status'=>7 ,'updated_at'=>time()]);
//        } elseif ($payStatus==3) {
//            OrderModel::where('id',$id)->update(['status'=>9 ,'updated_at'=>time()]);
//        } elseif ($payStatus==4) {
//            OrderModel::where('id',$id)->update(['status'=>11 ,'updated_at'=>time()]);
//        }
//        return redirect(DOMAIN.'member/order/'.$id);
//    }

//    /**
//     * 卖方确定已到款，下一步办理
//     */
//    public function setPayStatus($id,$cate,$status)
//    {
//        $orderModel = OrderModel::find($id);
//        if (!in_array($orderModel->genre,[5,6])) {
//            PayModel::where('order_id',$id)->update(['ispay'=>$status, 'updated_at'=>time()]);
//        } else {
//            $payModels = PayModel::where('order_id',$id)->get();
//            PayModel::where('id',$payModels[$cate-1])->update(['ispay'=>$status, 'updated_at'=>time()]);
//        }
//        return redirect(DOMAIN.'member/order/'.$id);
//    }
}