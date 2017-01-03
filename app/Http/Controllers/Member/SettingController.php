<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiUsers;
use App\Models\Base\AreaModel;
use Illuminate\Http\Request;
use Hash;
use Session;

class SettingController extends BaseController
{
    /**
     *会员认证管理
     */

    //isuser：1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，50超级用户
    protected $isusers = [
        1=>'普通用户','个人会员','普通企业','设计师','广告公司','影视公司','租赁公司',50=>'超级用户',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '会员账户';
        $this->lists['func']['url'] = 'setting';
    }

    public function show()
    {
        $rstUser = ApiUsers::getOneUser($this->userid);
        if ($rstUser['code']==0) {
            $data =  $rstUser['data'];
            $data['areaName'] = AreaModel::getAreaStr($rstUser['data']['area']);
        }
        if ($rstUser['code']==0 && in_array($data['isuser'],[1,2,4,50])) {
            $rstPerson = ApiPerson::getPersonInfo($rstUser['data']['id']);
            $personArr = $rstPerson['code']==0 ? $rstPerson['data'] : [];
        }
        if($rstUser['code']==0 && in_array($data['isuser'],[3,5,6,7,50])) {
            $rstCompany = ApiCompany::getOneCompany($rstUser['data']['id']);
            if ($rstCompany['code']==0) {
                $companyArr =  $rstCompany['data'];
                $companyArr['areaName'] = AreaModel::getAreaStr($rstCompany['data']['area']);
            }
        }
        $result = [
            'data'=> $data,
            'personArr'=> isset($personArr) ? $personArr : [],
            'companyArr'=> isset($companyArr) ? $companyArr : [],
            'lists'=> $this->lists,
        ];
        return view('member.setting.show', $result);
    }

    public function auth($id)
    {
        $rstUser = ApiUsers::getOneUser($id);
        $data = $rstUser['code']==0 ? $rstUser['data'] : [];
        $result = [
            'data'=> $data,
            'isusers'=> $this->isusers,
        ];
        return view('member.setting.auth', $result);
    }

    /**
     * 资料更新
     */
    public function update(Request $request,$id)
    {
        //基本信息
        if (isset($request->isuser) && !$request->isuser) {
            echo "<script>alert('用户类型必选！');history.go(-1);</script>";exit;
        }
        $user = [
            'email'=> $request->email,
            'qq'=> $request->qq,
            'tel'=> $request->tel,
            'mobile'=> $request->mobile,
            'isuser'=> isset($request->isuser)?$request->isuser:0,
            'id'=> $id,
        ];
        $rstUser = ApiUsers::modify($user);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }

        if (isset($request->isuser) && in_array($request->isuser,[2,4,50])) {
            //个人信息
            if (!$request->realname) {
                echo "<script>alert('真实名字必填！');history.go(-1);</script>";exit;
            }
            if (!isset($request->idcard)) {
                echo "<script>alert('身份证号码必填！');history.go(-1);</script>";exit;
            }
            $person = [
                'realname'=> $request->realname,
                'sex'=> $request->sex,
                'idcard'=> $request->idcard,
                'idfront'=> $request->idfront,
                'uid'=> $id,
            ];
            $rstPerson = ApiPerson::add($person);
            if ($rstPerson['code']!=0) {
                echo "<script>alert('".$rstPerson['msg']."');history.go(-1);</script>";exit;
            }
            $personInfo = [
                'per_id'    =>  $rstPerson['data']['id'],
                'realname'  =>  $rstPerson['data']['realname'],
                'sex'       =>  $rstPerson['data']['sex'],
                'idcard'    =>  $rstPerson['data']['idcard'],
                'idfront'   =>  $rstPerson['data']['idfront'],
            ];
        } elseif (isset($request->isuser) && in_array($request->isuser,[3,5,6,7,50])) {
            //公司信息
            $company = [
                'name'=> $request->name,
                'area'=> $request->area,
                'address'=> $request->address,
                'yyzzid'=> $request->yyzzid,
                'uid'=> $id,
            ];
            $rstCompany = ApiCompany::add($company);
            if ($rstCompany['code']!=0) {
                echo "<script>alert('".$rstCompany['msg']."');history.go(-1);</script>";exit;
            }
            $companyInfo = [
                'cid'   =>  $rstCompany['data']['id'],
                'name'  =>  $rstCompany['data']['name'],
                'area'  =>  $rstCompany['data']['area'],
                'address'   =>  $rstCompany['data']['address'],
                'yyzzid'    =>  $rstCompany['data']['yyzzid'],
            ];

//            //插入搜索表
//            $companyModel = CompanyModel::where($company)->first();
//            \App\Models\Home\SearchModel::change($companyModel,5,'create');

        }

        //更新Session
        $userInfoOld = unserialize(Session::get('user'));
        if (!isset($personInfo) && $userInfoOld['person']) {
            $personInfo = $userInfoOld['person'];
        }
        if (!isset($companyInfo) && $userInfoOld['company']) {
            $personInfo = $userInfoOld['company'];
        }
        $userInfo = [
            'uid'=> $userInfoOld['uid'],
            'username'=> $userInfoOld['username'],
            'email'=> $request->email,
            'userType'=> isset($request->isuser)?$request->isuser:$userInfoOld['userTpe'],
            'serial'=> $userInfoOld['serial'],
            'area'=> isset($request->area)?$request->area:0,
            'address'=> isset($request->address)?$request->address:'',
            'cid'=> isset($companyInfo['data'])?$companyInfo['data']['id']:0,
            'loginTime'=> $userInfoOld['loginTime'],
            'person'=> isset($personInfo)?serialize($personInfo):[],
            'company'=> isset($companyInfo)?serialize($companyInfo):[],
        ];
        Session::put('user',$userInfo);

        return redirect(DOMAIN.'member/setting');
    }

    /**
     * 修改密码
     */
    public function pwd($id)
    {
        $rstUser = ApiUsers::getOneUser($id);
        $data = $rstUser['code']==0 ? $rstUser['data'] : [];
        $result = [
            'data'=> $data,
        ];
        return view('member.setting.pwd', $result);
    }

    /**
     * 更新密码
     */
    public function updatepwd(Request $request,$id)
    {
        $rstUser = ApiUsers::getOneUser($id);
        $userModel = $rstUser['code']==0 ? $rstUser['data'] : [];
        if (!Hash::check($request->password,$userModel['password'])) {
            echo "<script>alert('密码错误！');history.go(-1);</script>";exit;
        }
        if (!$request->password2) {
            echo "<script>alert('新密码必填！');history.go(-1);</script>";exit;
        }
//        UserModel::where('id',$id)->update(['password'=> Hash::make($request->password2)]);
        return redirect(DOMAIN.'member/setting');
    }

    /**
     * 参数修改
     */
    public function info($id)
    {
        $rstUser = ApiUsers::getOneUser($id);
        $userArr = $rstUser['code']==0 ? $rstUser['data'] : [];
        $result = [
            'data'=> $userArr,
            'lists'=> $this->lists,
            'curr_list'=> '',
        ];
        return view('member.setting.info', $result);
    }

//    /**
//     * 参数更新
//     */
//    public function updateinfo(Request $request,$id)
//    {
//        UserModel::where('id',$id)->update(['limit'=> $request->limit]);
//        return redirect(DOMAIN.'member/setting');
//    }
}