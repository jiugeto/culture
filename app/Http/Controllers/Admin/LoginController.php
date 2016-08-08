<?php
namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
//use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Support\Facades\Session;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Models\Admin\AdminModel;
use App\Models\Admin\UserlogModel;

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

//    public function dologin()
//    {
//        if ($this->auth->attempt(['username'=>Input::get('username'), 'password'=>Input::get('password')])) {
//            return Redirect('admin/');
//        } else {
//            return Redirect('admin/login');
//        }
//    }
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
            'plat'=> 1,     //1管理员登录
            'uid'=> $adminModel->id,
            'uname'=> Input::get('username'),
            'loginTime'=> $loginTime,
            'serial'=> $serial,
            'created_at'=> $adminModel->created_at,
        ];
        UserlogModel::create($userlog);
        //加入session
        Session::put('admin.adminid',$adminModel->id);
        Session::put('admin.username',$username);
        Session::put('admin.password',$password);
        Session::put('admin.serial',$serial);
//        Session::put('admin.limit',$adminModel->limit);
        Session::put('admin.created_at',$adminModel->created_at);
        Session::put('admin.loginTime',$loginTime);

        return redirect('/admin');
    }

//    public function dologout()
//    {
//        if ($this->auth->check()) {
//            $this->auth->logout();
//        }
//        return Redirect('admin/login');
//    }
    public function dologout()
    {
        //更新用户日志表
        $logoutTime = time();
        UserlogModel::where('serial',Session::get('admin.serial'))
            ->update(['logoutTime'=>$logoutTime]);
        //去除session
        Session::forget('admin.adminid');
        Session::forget('admin.username');
        Session::forget('admin.password');
        Session::forget('admin.serial');
//        Session::forget('admin.limit');
        Session::forget('admin.created_at');
        Session::forget('admin.loginTime');
        return Redirect('/admin/login');
    }
}
