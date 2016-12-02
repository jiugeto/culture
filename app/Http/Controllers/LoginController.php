<?php
namespace App\Http\Controllers;

use App\Api\ApiUser\ApiUsers;
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
        //判断是否存在此用户
        $rst = ApiUsers::getOneUserByUname(Input::get('username'));
        if ($rst['code'] < 0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        } elseif ($rst['code'] == 1) {
            //验证密码正确否
            if (!(Hash::check(Input::get('password'),$rst['password']))) {
                echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
            }
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
//            'captcha.required' => '请输入验证码',
//            'captcha.captcha' => '验证码错误，请重试',
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            echo "<script>alert('验证码错误！');history.go(-1);</script>";exit;
        }
        //个人资料
        if (in_array($userModel->isuser,[1,2,4,50])) {
            $personModel = PersonModel::where('uid',$userModel->id)->first();
            $persons['per_id'] = $personModel->id;
            $persons['realname'] = $personModel->realname;
            $persons['sex'] = $personModel->sex;
            $persons['idcard'] = $personModel->idcard;
            $persons['idfront'] = $personModel->idfront;
        }
        $userperson = isset($persons) ? serialize($persons) : [];
        //企业资料
        if (in_array($userModel->isuser,[3,5,6,7,50])) {
            $companyModel = CompanyModel::where('uid',$userModel->id)->first();
            $companys['cid'] = $companyModel->id;
            $companys['name'] = $companyModel->name;
            $companys['area'] = $companyModel->area;
            $companys['address'] = $companyModel->address;
            $companys['yyzzid'] = $companyModel->yyzzid;
        }
        $usercompany = isset($companys) ? serialize($companys) : [];

        $serial = date('YmdHis',time()).rand(0,10000);
        $userInfo = [
            'uid'=> $userModel->id,
            'username'=> Input::get('username'),
            'email'=> $userModel->email,
            'userType'=> $userModel->isuser,
            'serial'=> $serial,
            'area'=> $userModel->area,
            'address'=> $userModel->address,
            'cid'=> isset($companyModel)?$companyModel->id:'',
            'loginTime'=> time(),
            'person'=> $userperson,
            'company'=> $usercompany,
        ];
        Session::put('user',$userInfo);

        //登陆加入用户日志表
        $ip = \App\Tools::getIp();
        $ipaddress = \App\Tools::getCityByIp($ip);
        $userlog = [
            'uid'=> $userModel->id,
            'uname'=> Input::get('username'),
            'genre'=> 1,    //1代表用户
            'serial'=> $serial,
            'ip'=> $ip,
            'ipaddress'=> $ipaddress,
            'action'=> $_SERVER['REQUEST_URI'],
            'loginTime'=> time(),
            'created_at'=> $userModel->created_at,
        ];
        LogModel::create($userlog);

        //最近登录更新
        UserModel::where('id',$userModel->id)->update(['lastLogin'=> time()]);

        return redirect(DOMAIN.'member');
    }

    public function dologout()
    {
        //更新用户日志表
        $rsttLog =
        LogModel::where('serial',Session::get('user.serial'))
                    ->update(['logoutTime'=> time()]);
        //去除session
        Session::forget('user');
        return redirect(DOMAIN.'login');
    }
}