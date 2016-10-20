<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Session;
use App\Models\Admin\AdminModel;
use App\Models\Admin\LogModel;
use Hash;

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
        //验证
        $adminModel = AdminModel::where('username',$username)->first();
        if (!$adminModel) {
            echo "<script>alert('无此管理员！');history.go(-1);</script>";exit;
        }
        if ($adminModel && !Hash::check($password,$adminModel->password)) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }

        $serial = date('YmdHis',time()).rand(0,10000);
        $loginTime = time();
        //加入session
        $adminInfo = [
            'adminid'=> $adminModel->id,
            'username'=> $adminModel->username,
            'role_id'=> $adminModel->role_id,
            'role_name'=> $adminModel->role(),
            'serial'=> $serial,
            'createTime'=> $adminModel->createTime(),
            'loginTime'=> date('Y年m月d日 H:i',$loginTime),
        ];
        Session::put('admin',$adminInfo);

        //登陆加入用户日志表
        $ip = \App\Tools::getIp();
        $ipaddress = \App\Tools::getCityByIp($ip);
        $userlog = [
            'uid'=> $adminModel->id,
            'uname'=> Input::get('username'),
            'ip'=> $ip,
            'genre'=> 2,    //2代表管理员
            'serial'=> $serial,
            'ipaddress'=> $ipaddress,
            'action'=> $_SERVER['REQUEST_URI'],
            'loginTime'=> $loginTime,
            'created_at'=> $adminModel->created_at,
        ];
        LogModel::create($userlog);

        return redirect(DOMAIN.'admin');
    }
    public function dologout()
    {
        //更新用户日志表
        $logoutTime = time();
        LogModel::where('serial',Session::get('admin.serial'))
            ->update(['logoutTime'=>$logoutTime]);
        //去除session
        Session::forget('admin');
        return Redirect(DOMAIN.'admin/login');
    }
}
