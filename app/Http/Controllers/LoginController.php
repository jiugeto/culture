<?php
namespace App\Http\Controllers;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiLog;
use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiUsers;
use App\Tools;
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
        $rstLogin = ApiUsers::doLogin($data);
        if ($rstLogin['code'] != 0) {
            //验证密码正确否
            if (!(Hash::check(Input::get('password'),$rstLogin['password']))) {
                echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
            }
            echo "<script>alert('".$rstLogin['msg']."');history.go(-1);</script>";exit;
//            return redirect(DOMAIN.'regist/fail');
        }

        //个人资料
        if (in_array($rstLogin['data']['isuser'],[1,2,4,50])) {
            $personInfo = ApiPerson::getPersonInfo($rstLogin['data']['id']);
            if ($personInfo['code'] != 0) {
                $person = array();
            } else {
                $person['per_id'] = $personInfo['data']['id'];
                $person['realname'] = $personInfo['data']['realname'];
                $person['sex'] = $personInfo['data']['sex'];
                $person['idcard'] = $personInfo['data']['idcard'];
                $person['idfront'] = $personInfo['data']['idfront'];
            }
        }
//        $userperson = isset($person) ? serialize($person) : [];
        //企业资料
        if (in_array($rstLogin['data']['isuser'],[3,5,6,7,50])) {
            $companyInfo = ApiCompany::getOneCompany($rstLogin['data']['id']);
            if ($companyInfo['code'] != 0) {
                $company = array();
            } else {
                $company['cid'] = $companyInfo['data']['id'];
                $company['name'] = $companyInfo['data']['name'];
                $company['area'] = $companyInfo['data']['area'];
                $company['address'] = $companyInfo['data']['address'];
                $company['yyzzid'] = $companyInfo['data']['yyzzid'];
            }
        }
//        $usercompany = isset($company) ? serialize($company) : [];

        $serial = date('YmdHis',time()).rand(0,10000);
        $userInfo = [
            'uid'=> $rstLogin['data']['id'],
            'username'=> Input::get('username'),
            'email'=> $rstLogin['data']['email'],
            'userType'=> $rstLogin['data']['isuser'],
            'serial'=> $serial,
            'area'=> $rstLogin['data']['area'],
            'address'=> $rstLogin['data']['address'],
            'cid'=> isset($companyInfo['data'])?$companyInfo['data']['id']:0,
            'loginTime'=> time(),
            'person'=> $person,
            'company'=> $company,
        ];
        $userInfo['cookie'] = $_COOKIE;
        Session::put('user',$userInfo);
        \Cookie::make('user', $userInfo, 720);       //cookie12小时

        //将session放入redis
        \Redis::setex('cul_session', $this->redisTime*60, serialize($userInfo));

        return redirect(DOMAIN.'member');
    }

    public function dologout()
    {
        //更新用户日志表
        $rstLog = ApiLog::logout(Session::get('user.serial'));
        if ($rstLog['code']!=0) {
            echo "<script>alert('".$rstLog['msg']."');history.go(-1);</script>";exit;
        }
        //去除session
        Session::forget('user');
        \Cookie::forget('user');
        \Redis::del('cul_session');
        return redirect(DOMAIN.'login');
    }
}