<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\UserModel;
use Session;
use Hash;
use Illuminate\Support\Facades\Input;
use Validator;

class LoginController extends Controller
{
    /**
     * 会员注册页面
     * 支持手机、邮箱、用户名
     */

    public function index()
    {
        return view('loginOrRegist.login');
    }

    public function dologin()
    {
        $userModel = UserModel::where('username',Input::get('username'))->first();
        //查看是否有此用户
        if (!$userModel) { echo "<script>alert('没有此用户！');history.go(-1);</script>";exit; }
        //验证密码正确否
        if (!(Hash::check(Input::get('password'),$userModel->password))) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }
        //查看2次密码输入是否一致
        if (Input::get('password')!=Input::get('password2')) {
            echo "<script>alert('2次密码输入不一致！');history.go(-1);</script>";exit;
        }
        //验证码验证
        $rules = [
            'captcha' => 'required|captcha',
        ];
        $messages = [
            'captcha.required' => '请输入验证码',
            'captcha.captcha' => '验证码错误，请重试',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
            return redirect('/login');
        }
//        dd(Input::all());

        //加入session
        Session::put('user.uid',$userModel->id);
        Session::put('user.username',Input::get('username'));
        Session::put('user.password',Input::get('password'));
        Session::put('user.email',$userModel->email);
        return redirect('/member');
    }

    public function dologout()
    {
        Session::forget('user.uid');
        Session::forget('user.username');
        Session::forget('user.password');
        Session::forget('user.email');
        return redirect('/login');
    }
}