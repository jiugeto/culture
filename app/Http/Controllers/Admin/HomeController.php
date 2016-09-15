<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Admin\LogModel;
use App\Models\Base\OrderFirmModel;
use App\Models\Base\OrderModel;
use App\Models\Base\OrderProductModel;
use App\Models\UserModel;

class HomeController extends BaseController
{
    /**
     * 系统后台首页
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'users'=> $this->users(),
            'orders'=> $this->orders(),
        ];
        return view('admin.home.index', $result);
    }





    public function users()
    {
        $users_all = UserModel::all();
        $users_week = LogModel::where('loginTime','>',time()-3600*24*7)
            ->distinct('uid')
//            ->orderBy('id','desc')
            ->get();
        $users_hour = LogModel::where('loginTime','>',time()-3600)
            ->distinct('uid')
//            ->orderBy('id','desc')
            ->get();
        //最新注册用户
        $datas = UserModel::where('isauth','>',0)
            ->where('created_at','>',time()-3600*24*7)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        if (!count($datas)) {
            $datas = UserModel::where('isauth','>',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return array(
            'datas'=> $datas,
            'all'=> count($users_all),
            'week'=> count($users_week),
            'hour'=> count($users_hour),
        );
    }

    public function orders()
    {
        $orders_create = OrderProductModel::all();
        $orders_all = OrderModel::all();
        $orders_firm = OrderFirmModel::all();
        //各个订单
        $orders_C = OrderProductModel::where('del',0)
            ->where('isshow',1)
            ->paginate($this->limit);
        $orders_A = OrderModel::where('del',0)
            ->where('isshow',1)
            ->paginate($this->limit);
        $orders_F = OrderFirmModel::where('del',0)
            ->where('isshow',1)
            ->paginate($this->limit);
        return array(
            'create'=> count($orders_create),
            'all'=> count($orders_all),
            'firm'=> count($orders_firm),
            'ordersC'=> $orders_C,
            'ordersA'=> $orders_A,
            'ordersF'=> $orders_F,
        );
    }
}