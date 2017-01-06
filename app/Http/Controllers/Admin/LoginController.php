<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiAdmin;
use App\Api\ApiUser\ApiLog;
use Illuminate\Support\Facades\Input;
use Hash;
use Session;
use Redis;

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        return view('admin.loginOrReg.login');
    }

    public function dologin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $rstAdmin = ApiAdmin::getOneAdminByUname($username);
        if ($rstAdmin['code'] != 0) {
            echo "<script>alert('".$rstAdmin['msg']."');history.go(-1);</script>";exit;
        }
        if (!Hash::check($password,$rstAdmin['data']['password'])) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }

        $serial = date('YmdHis',time()).rand(0,10000);
        $loginTime = time();
        //加入session
        $adminInfo = [
            'adminid'=> $rstAdmin['data']['id'],
            'username'=> $rstAdmin['data']['username'],
            'role_id'=> $rstAdmin['data']['role_id'],
            'role_name'=> $rstAdmin['data']['roleName'],
            'serial'=> $serial,
            'createTime'=> $rstAdmin['data']['createTime'],
            'loginTime'=> date('Y年m月d日 H:i',$loginTime),
        ];
        Session::put('admin',$adminInfo);

        //登陆加入用户日志表
        $ip = \App\Tools::getIp();
        $ipaddress = \App\Tools::getCityByIp($ip);
        $userlog = [
            'uid'=> $rstAdmin['data']['id'],
            'uname'=> Input::get('username'),
            'ip'=> $ip,
            'genre'=> 2,    //2代表管理员
            'serial'=> $serial,
            'ipaddress'=> $ipaddress,
            'action'=> $_SERVER['REQUEST_URI'],
        ];
        $rstLog = ApiLog::add($userlog);
        if ($rstLog['code'] != 0) {
            echo "<script>alert('管理员日志错误！');history.go(-1);</script>";exit;
        }

        //将session放入redis
        Redis::setex('cul_admin_session', $this->redisTime, serialize($adminInfo));

        return redirect(DOMAIN.'admin');
    }
    public function dologout()
    {
        //更新用户日志表
        $rstLog = ApiLog::logout(Session::get('admin.serial'));
        if (!$rstLog) {
            echo "<script>alert('".$rstLog['msg']."');history.go(-1);</script>";exit;
        }
        //去除session
        Session::forget('admin');
        Redis::del('cul_admin_session');
        return Redirect(DOMAIN.'admin/login');
    }
}
