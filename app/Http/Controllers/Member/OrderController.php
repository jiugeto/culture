<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiOrder;
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
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $this->query($pageCurr),
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
//    public function create()
//    {
//        if (AjaxRequest::ajax()) {
//            $data = Input::all();
//            //假如已有类似订单
//            $order = OrderModel::where(['genre'=>$data['genre'], 'fromid'=>$data['id']])->first();
//            if (count($order)) {
//                echo json_encode(array('code'=>'-2', 'message' =>'你已经申请此订单，不能重复申请！'));exit;
//            }
//
//            //1创意供应，2创意需求，3分镜供应，4分镜需求，5视频供应，6视频需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
//            if (in_array($data['genre'],[1,2])) {
//                $ideaModel = \App\Models\IdeasModel::find($data['id']);
//                $productname = $ideaModel->name;
//                $sellerid = $ideaModel->uid;
//            } elseif (in_array($data['genre'],[3,4])) {
//                $storyBoardModel = \App\Models\StoryBoardModel::find($data['id']);
//                $productname = $storyBoardModel->name;
//                $sellerid = $storyBoardModel->uid;
//            } elseif (in_array($data['genre'],[5,6])) {
//                $videoModel = \App\Models\Base\VideoModel::find($data['id']);
//                $productname = $videoModel->name;
//                $sellerid = $videoModel->uid;
//            }
//            //获取供应方信息
//            $userModel = UserModel::find($sellerid);
//            //插入订单表
//            $order = [
//                'name'=> $productname,
//                'serial'=> date('YmdHis',time()).rand(0,10000),
//                'genre'=> $data['genre'],
//                'fromid'=> $data['id'],
//                'seller'=> $sellerid,
//                'sellerName'=> $userModel->username,
//                'buyer'=> $this->userid,
//                'buyerName'=> \Session::get('user.username'),
//                'status'=> 1,
//                'created_at'=> time(),
//            ];
//            OrderModel::create($order);
//            //插入支付表
//            $orderModel = OrderModel::where($order)->first();
//            $pay = [
//                'genre'=> 1,    //1订单表，2售后服务，3在线创作订单
//                'order_id'=> $orderModel->id,
//                'created_at'=> time(),
//            ];
//            PayModel::create($pay);
//            echo json_encode(array('code'=>'0', 'message' =>'操作成功！'));exit;
//        }
//        echo json_encode(array('code'=>'-1', 'message' =>'非法操作!'));exit;
//    }

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

    public function query($pageCurr)
    {
        $apiOrder = ApiOrder::index($this->limit,$pageCurr,2,0);
        return $apiOrder['code']==0 ? $apiOrder['data'] : [];
    }
}