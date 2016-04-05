<?php
namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Session;
use Session;
use App\Models\Admin\AdminModel;
//use Illuminate\Http\Request;

class LoginController extends BaseController
{
//    public function __construct(Guard $auth)
//    {
//        $this->auth = $auth;
//    }

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
//        dd(Session::get('admin'));
        Session::put('admin.username',$username);
        Session::put('admin.password',$password);
        return redirect('/admin/');
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
        Session::forget('admin.username');
        Session::forget('admin.password');
        return Redirect('/admin/login');
    }
}
