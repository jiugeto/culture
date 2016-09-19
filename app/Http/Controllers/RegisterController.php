<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Tools;
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
        //查看同ip是否已有3个注册，满3个则限制
        if (count(UserModel::where('ip',Tools::getIp())->get())==3) {
            echo "<script>alert('此用户已经注册过，不要重复注册！');history.go(-1);</script>";exit;
        }
        //查看是否有此用户
        if (UserModel::where('username',Input::get('username'))->first()) {
            echo "<script>alert('此用户已经注册！');history.go(-1);</script>";exit;
        }
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
        }

        //数据写入用户表
        $data = [
            'username'=> Input::get('username'),
            'password'=> Hash::make(Input::get('password')),
            'ip'=> Tools::getIp(),
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
            'uid'=> $userinfo->id,
            'uname'=> Input::get('username'),
            'genre'=> 1,    //1代表用户
            'serial'=> $serial,
            'ip'=> $ip,
            'ipaddress'=> $ipaddress,
            'action'=> $_SERVER['REQUEST_URI'],
            'loginTime'=> time(),
            'created_at'=> $userinfo->created_at,
        ];
        \App\Models\Admin\LogModel::create($userlog);

        return redirect(DOMAIN.'regist/success');
    }

    public function success()
    {
        return view('loginOrRegist.success');
    }
}