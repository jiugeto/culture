<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\UserModel;
use Session;
use Hash;
use Illuminate\Support\Facades\Input;
use Validator;

class RegisterController extends Controller
{
    /**
     * 会员注册页面
     * 支持手机、邮箱、用户名
     */

    public function index()
    {
        return view('loginOrRegist.regist');
    }

    public function doregist()
    {
        $userModel = UserModel::where('username',Input::get('username'))->first();
        //查看是否有此用户
        if ($userModel) { echo "<script>alert('此用户已经注册！');history.go(-1);</script>";exit; }
//        //验证密码正确否
//        if (!(Hash::check(Input::get('password'),$userModel->password))) {
//            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
//        }
        //查看2次密码输入是否一致
        if (Input::get('password')!=Input::get('password2')) {
            echo "<script>alert('2次密码输入不一致！');history.go(-1);</script>";exit;
        }

        //验证码验证
        $rules = [
        ];
        $messages = [
            'captcha.required' => '请输入验证码',
            'captcha.captcha' => '验证码错误，请重试',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
//            return redirect('/regist');
        }

        //数据写入用户表
        $data = [
            'username'=> Input::get('username'),
            'password'=> Hash::make(Input::get('password')),
            'email'=> Input::get('email'),
            'created_at'=> time(),
            'lastLogin'=> time(),
        ];
        UserModel::create($data);

        //加入session
        $userinfo = UserModel::where('username',Input::get('username'))->first();
        $userInfo = [
            'uid'=> $userinfo->id,
            'username'=> Input::get('username'),
            'email'=> Input::get('email'),
        ];
        Session::put('user',$userInfo);

        //登陆加入用户日志表
        $serial = date('YmdHis',time()).rand(0,10000);
        $ip = \App\Tools::getIp();
        $ipaddress = \App\Tools::getCityByIp($ip);
        $userlog = [
            'uid'=> $userModel->id,
            'uname'=> Input::get('username'),
            'ip'=> $ip,
            'ipaddress'=> $ipaddress,
            'loginTime'=> time(),
            'serial'=> $serial,
            'created_at'=> $userModel->created_at,
        ];
        \App\Models\Admin\UserlogModel::create($userlog);

        return redirect('/regist/success');
    }

    public function success()
    {
        return view('loginOrRegist.success');
    }
}