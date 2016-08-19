<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use Session;
use App\Models\Admin\AdminModel;
use App\Models\Admin\AdminlogModel;

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
        if ($adminModel && $password!=$adminModel->password) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }

        $serial = date('YmdHis',time()).rand(0,10000);
        $loginTime = time();
        //登陆加入用户日志表
        $userlog = [
            'uid'=> $adminModel->id,
            'uname'=> Input::get('username'),
            'loginTime'=> $loginTime,
            'serial'=> $serial,
            'created_at'=> $adminModel->created_at,
        ];
        AdminLogModel::create($userlog);
        //加入session
        Session::put('admin.adminid',$adminModel->id);
        Session::put('admin.username',$username);
        Session::put('admin.password',$password);
        Session::put('admin.serial',$serial);
        Session::put('admin.created_at',$adminModel->created_at);
        Session::put('admin.loginTime',$loginTime);

        return redirect(DOMAIN.'admin');
    }
    public function dologout()
    {
        //更新用户日志表
        $logoutTime = time();
        AdminlogModel::where('serial',Session::get('admin.serial'))
            ->update(['logoutTime'=>$logoutTime]);
        //去除session
        Session::forget('admin.adminid');
        Session::forget('admin.username');
        Session::forget('admin.password');
        Session::forget('admin.serial');
        Session::forget('admin.created_at');
        Session::forget('admin.loginTime');
        return Redirect(DOMAIN.'admin/login');
    }
}
