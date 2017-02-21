<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiOrder;
use App\Api\ApiOnline\ApiOrderPro;
use App\Api\ApiUser\ApiLog;
use App\Api\ApiUser\ApiUsers;
use App\Http\Requests;

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
        //所有用户
        $rstUsers_all = ApiUsers::getUsersByTime('');
        $users_all = $rstUsers_all['code']==0 ? $rstUsers_all['data'] : [];
        //一周内登录
        $rstUsers_week = ApiLog::getLogsByTime(1,time()-3600*24*7);
        $users_week = $rstUsers_week['code']==0 ? $rstUsers_week['data'] : [];
        //今天登录
        $rstUsers_day = ApiLog::getLogsByTime(1,time()-3600);
        $users_day = $rstUsers_day['code']==0 ? $rstUsers_day['data'] : [];
        //最新注册用户
        $rstUsers = ApiUsers::getUsersByTime(time()-3600*24*7);
        $datas = $rstUsers['code']==0 ?$rstUsers['data'] : [];
        if (!count($datas)) {
            $rstUsers2 = ApiUsers::getUsersByTime(0);
            $datas = $rstUsers2['code']==0 ?$rstUsers2['data'] : [];
        }
        return array(
            'datas'=> $datas,
            'all'=> count($users_all),
            'week'=> count($users_week),
            'day'=> count($users_day),
        );
    }

    public function orders()
    {
        $apiOrder_C = ApiOrderPro::getOrders(0,0);
        $orders_create = $apiOrder_C['code']==0 ? $apiOrder_C['data'] : [];
        $apiOrder_Main = ApiOrder::getOrdersByLimit(0,0);
        $orders_main = $apiOrder_Main['code']==0 ? $apiOrder_Main['data'] : [];
        return array(
            'create'=> $orders_create,
            'main'=> $orders_main,
        );
    }
}