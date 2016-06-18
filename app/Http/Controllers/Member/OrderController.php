<?php
namespace App\Http\Controllers\Member;

//use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\UserModel;

class OrderController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderModel();
        //面包屑处理
        $this->lists['func']['name'] = '订单管理';
        $this->lists['func']['url'] = 'order';
//        $this->lists['create']['name'] = '添加类型';
//        $this->lists['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '订单列表';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/member/order',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.order.index', $result);
    }

    /**
     * 前台下的订单，这里统一处理
     */
    public function create()
    {
        if (\Illuminate\Support\Facades\Request::ajax()) {
            $data = \Illuminate\Support\Facades\Input::all();
            //加入已有类似订单
            //1创意，2分镜，3商品，4娱乐，5演员，6租赁
            if ($data['genre']==1) {
                $ideaModel = \App\Models\IdeasModel::find($data['id']);
                $productname = $ideaModel->name;
                $sellerid = $ideaModel->uid;
            }
            //获取供应方信息
            $userModel = UserModel::find($sellerid);
            $create = [
                'name'=> $productname,
                'serial'=> date('YmdHis',time()).rand(0,10000),
                'genre'=> $data['genre'],
                'fromid'=> $data['id'],
                'seller'=> $sellerid,
                'sellerName'=> $userModel->username,
                'buyer'=> $this->userid,
                'buyerName'=> \Session::get('user.username'),
//                'number'=> 0,
                'status'=> 1,        //新创意订单
                'created_at'=> date('Y-m-d H:i:s',time()),
            ];
            OrderModel::create($create);

            echo json_encode(array('code'=>'0', 'message' =>'操作成功！'));exit;
        }
//        return redirect('/member/order');
        echo json_encode(array('code'=>'-1', 'message' =>'非法操作!'));exit;
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> OrderModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'userid'=> $this->userid,
        ];
        return view('member.order.show', $result);
    }

    /**
     * 设置创意价格
     */
    public function setIdeaMoney($id,$money)
    {
        if (!$money) { $status = 3; }else{ $status = 4; }
        $update = [
            'ideaMoney'=> $money,
            'status'=>$status,
            'ideaTime'=>date('Y-m-d H:i:s',time())
        ];
        OrderModel::where('id',$id)->update($update);
        return redirect('/member/order/'.$id);
    }

    /**
     * 设置分镜价格
     */
    public function setStoryMoney($id,$money)
    {
        if (!$money) { $status = 8; }else{ $status = 9; }
        $update = [
            'storyMoney'=> $money,
            'status'=>$status,
            'storyTime'=>date('Y-m-d H:i:s',time())
        ];
        OrderModel::where('id',$id)->update($update);
        return redirect('/member/order/'.$id);
    }

    /**
     * 设置状态
     */
    public function setStatus($id,$status)
    {
        OrderModel::where('id',$id)->update(['status'=> $status]);
        return redirect('/member/order/'.$id);
    }

    /**
     * 设置分期价格
     */
    public function setRealMoney($id,$real,$money)
    {
        if ($real==1) {     //一期，确认收款，协商效果
            $update = [
                'realMoney1'=> $money,
                'status'=> 13,
            ];
        } elseif ($real==2) {       //二期，确认收款，协商效果
            $update = [
                'realMoney2'=> $money,
                'status'=> 15,
            ];
        } elseif ($real==3) {       //三期，确认收款，协商效果
            $update = [
                'realMoney2'=> $money,
                'status'=> 17,
            ];
        } elseif ($real==4) {       //四期，确认尾款
            $update = [
                'realMoney2'=> $money,
                'status'=> 19,
            ];
        }
        $update['realTime'] = date('Y-m-d H:i:s',time());
        OrderModel::where('id',$id)->update($update);
        return redirect('/member/order/'.$id);
    }

    public function query()
    {
        $datas = OrderModel::where('del',0)
            ->where('isshow',1)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        return $datas;
    }
}