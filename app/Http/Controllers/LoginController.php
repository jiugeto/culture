<?php
namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Admin\UserlogModel;
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

        $serial = date('YmdHis',time()).rand(0,10000);
        //加入session
        Session::put('user.uid',$userModel->id);
        Session::put('user.username',Input::get('username'));
        Session::put('user.password',Input::get('password'));
        Session::put('user.email',$userModel->email);
        Session::put('user.serial',$serial);
        Session::put('user.limit',$userModel->limit);
        Session::put('user.area',$userModel->area);
        Session::put('user.address',$userModel->address);

        //登陆加入用户日志表
        $userlog = [
            'plat'=> 2,     //1用户登录
            'uid'=> $userModel->id,
            'uname'=> Input::get('username'),
            'loginTime'=> date('Y-m-d',time()),
            'serial'=> $serial,
            'created_at'=> $userModel->created_at,
        ];
        UserlogModel::create($userlog);

        return redirect('/member');
    }

    public function dologout()
    {
        //更新用户日志表
        $logoutTime = date('Y-m-d',time());
        UserlogModel::where('serial',Session::get('user.serial'))
                    ->update(['logoutTime'=>$logoutTime]);
        //去除session
        Session::forget('user.uid');
        Session::forget('user.username');
        Session::forget('user.password');
        Session::forget('user.email');
        Session::forget('user.serial');
        Session::forget('user.limit');
        Session::forget('user.area');
        Session::forget('user.address');
        return redirect('/login');
    }
}