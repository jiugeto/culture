<?php
namespace App\Http\Controllers\Online;

use App\Models\Base\PayModel;
use App\Models\Online\OrderProductModel;

class OrderController extends BaseController
{
    /**
     * 前台创作订单管理
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query([1,2,3],$this->limit),
            'prefix_url'=> DOMAIN.'online/u/order',
        ];
        return view('online.order.index', $result);
    }

    /**
     * 创作的渲染订单
     */
    public function getApply($productid,$renderMoney,$totalMoney)
    {
        if (!$productid || !$renderMoney || !$totalMoney) {
            echo "<script>alert('参数有误！');history.go(-1);</script>";exit;
        }

        $formats = array_flip($this->orderProModel['formatMoneys']);
        $serial = date('YmdHis',time()).rand(0,10000);
        $data = [
            'productid'=> $productid,
            'serial'=> $serial,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'format'=> $formats[$renderMoney],
            'created_at'=> time(),
        ];
        OrderProductModel::create($data);
        $orderModel = OrderProductModel::where('serial',$serial)->first();

        $pay = [
            'genre'=> 3,    //代表创作订单
            'order_id'=> $orderModel->id,
            'money'=> $totalMoney,
            'created_at'=> time(),
        ];
        PayModel::create($pay);
        return redirect(DOMAIN.'online/u/order');
    }

    public function getFinish()
    {
        $result = [
            'datas'=> $this->query(4,12),
            'prefix_url'=> DOMAIN.'online/u/order/finish',
        ];
        return view('online.order.finish', $result);
    }






    public function query($status,$limit)
    {
        if (is_array($status)) {
            //status<4未成功渲染的
            $datas = OrderProductModel::where('status','<',4)
                ->where('isshow',2)
                ->orderBy('id','desc')
                ->paginate($limit);
        } elseif ($status==4) {
            $datas = OrderProductModel::where('status',4)
                ->where('isshow',2)
                ->orderBy('id','desc')
                ->paginate($limit);
        }
        $datas->limit = $limit;
        return $datas;
    }
}