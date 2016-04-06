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
//            'username' => 'required|max:15',
            'captcha' => 'required|captcha',
//            'password' => 'required|between:6,12|confirmed',
//            'password_confirmation' => 'required|between:6,12',
//            'email' => 'required|email|max:50',
        ];
        $messages = [
//            'username.unique' => '用户名已经存在',
//            'username.max' => '不能超过15个字符',
            'captcha.required' => '请输入验证码',
            'captcha.captcha' => '验证码错误，请重试',
//            'email.required' => '必填',
//            'email.email' => '格式不正确',
//            'email.max' => '不能超过50个字符',
//            'password.required' => '请输入密码',
//            'password.between' => '密码6-12个字符',
//            'password.confirmed' => '两次密码输入不一致',
//            'password_confirmation.required' => '请输入重复密码',
//            'password_confirmation.between' => '重复密码6-12个字符',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
//        dd($validator->fails());
        if ($validator->fails()) {
//            return redirect('/regist')
//                ->withErrors($validator)
//                ->with([
//                    'username'=>Input::get('username'),
//                    'email'=>Input::get('email')
//                ]);
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
            return redirect('/regist');
        }

        //数据写入用户表
        $data = [
            'username'=> Input::get('username'),
            'password'=> Hash::make(Input::get('password')),
            'email'=> Input::get('email'),
            'created_at'=> date('Y-m-d H:i:s', time()),
        ];
        UserModel::create($data);

        //加入session
        $userinfo = UserModel::where('username',Input::get('username'))->first();
        Session::put('user.uid',$userinfo->id);
        Session::put('user.username',Input::get('username'));
        Session::put('user.password',Input::get('password'));
        Session::put('user.email',Input::get('email'));

        return redirect('/regist/success');
    }

    public function success()
    {
        return view('loginOrRegist.success');
    }
}