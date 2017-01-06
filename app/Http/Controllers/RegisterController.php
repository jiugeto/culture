<?php
namespace App\Http\Controllers;

use App\Api\ApiUser\ApiLog;
use App\Api\ApiUser\ApiUsers;
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
//        //查看同ip是否已有3个注册，满3个则限制
//        if (count(UserModel::where('ip',Tools::getIp())->get())==3) {
//            echo "<script>alert('此用户已经注册过，不要重复注册！');history.go(-1);</script>";exit;
//        }
        //查看2次密码输入是否一致
        if (Input::get('password')!=Input::get('password2')) {
            echo "<script>alert('2次密码输入不一致！');history.go(-1);</script>";exit;
        }
        //验证码验证
        $rules = [];
        $messages = [
            'captcha.required' => '请输入验证码',
            'captcha.captcha' => '验证码错误，请重试',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
        }

        //接口验证数据，写入用户表，或者返回错误信息
        $ip = Tools::getIp();
        $data = [
            'username'=> Input::get('username'),
            'password'=> Hash::make(Input::get('password')),
            'pwd'=> Input::get('password'),
            'ip'=> $ip,
            //以下用户日志用
            'ipaddress'=> Tools::getCityByIp($ip),
            'genre'=>   1,      //1代表用户,2代表管理员
            'action'=> $_SERVER['REQUEST_URI'],
        ];
        $rstRegist = ApiUsers::doRegist($data);
        if ($rstRegist['code'] != 0) {
            echo "<script>alert('".$rstRegist['msg']."');history.go(-1);</script>";exit;
//            return redirect(DOMAIN.'regist/fail');
        }

        //放入session
        $userInfo = [
            'uid'       =>  $rstRegist['data']['id'],
            'username'  =>  Input::get('username'),
            'email'     =>  $rstRegist['data']['email'],
            'userType'  =>  $rstRegist['data']['isuser'],
            'area'      =>  $rstRegist['data']['area'],
            'address'   =>  $rstRegist['data']['address'],
            'loginTime' =>  time(),
        ];
        Session::put('user',$userInfo);

        //将session放入redis
        \Redis::setex('cul_session', $this->redisTime, serialize($userInfo));

        return redirect(DOMAIN.'regist/success');
    }

    /**
     * 成功页面
     */
    public function success()
    {
        return view('loginOrRegist.success');
    }

    /**
     * 失败页面
     */
    public function fail()
    {
        return view('loginOrRegist.success');
    }
}