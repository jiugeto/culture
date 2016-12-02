<?php
namespace App\Http\Controllers;

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
        //判断是否存在此用户
        $rstUser = ApiUsers::getOneUserByUname(Input::get('username'));
        if ($rstUser['code'] != 0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        //查看2次密码输入是否一致
        if (Input::get('password')!=Input::get('password2')) {
            echo "<script>alert('2次密码输入不一致！');history.go(-1);</script>";exit;
        }
        //验证码验证
        $rules = [];
        $messages = [
//            'captcha.required' => '请输入验证码',
//            'captcha.captcha' => '验证码错误，请重试',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
        }

        //数据写入用户表
        $ip = Tools::getIp();
        $data = [
            'username'=> Input::get('username'),
            'password'=> Hash::make(Input::get('password')),
            'pwd'=> Input::get('password'),
            'ip'=> $ip,
            //以下用户日志用
            'ipaddress'=> Tools::getCityByIp($ip),
            'genre'=>   1,      //1代表用户,2代表管理员
        ];
        $rstRegist = ApiUsers::doRegist($data);
        if ($rstRegist['code'] != 0) {
            return redirect(DOMAIN.'regist/fail');
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

        return redirect(DOMAIN.'regist/success');
    }

//    public function getPerson($uid){}

//    public function getCompany($uid){}

    public function success()
    {
        return view('loginOrRegist.success');
    }

    public function fail()
    {
        return view('loginOrRegist.success');
    }
}