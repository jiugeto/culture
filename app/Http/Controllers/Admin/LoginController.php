<?php
namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
//use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\AdminModel;
use Illuminate\Http\Request;

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
    public function dologin(Request $request)
    {
        $admin = AdminModel::where(['username'=>$request->username])->first();
        if ($admin && $request->password==$admin->password) {
            Session::put('admin.username',$request->username);
            Session::put('admin.password',$request->password);
            dd(Session::get('admin'));
            return redirect('/admin');
        } else {
            return redirect('/admin/login');
        }
    }

//    public function dologout()
//    {
//        if ($this->auth->check()) {
//            $this->auth->logout();
//        }
//        return Redirect('admin/login');
//    }
}
