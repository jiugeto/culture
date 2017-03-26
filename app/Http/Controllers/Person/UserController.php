<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiMessage;
use App\Api\ApiUser\ApiLog;
use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiSign;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use Session;
use Hash;

class UserController extends BaseController
{
    /**
     * 个人后台 用户管理
     */

    protected $curr = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $apiMsg = ApiMessage::index(10,1,$this->userid,1,0,2,0);
        $result = [
            'frields' => $this->frields(),
            'signs' => $this->signs(),
            'userRegistLog' => $this->firstLog(),
            'userLastLog' => $this->lastLog(),
            'messageNum' => $apiMsg['code']==0 ? $apiMsg['pagelist']['total'] : 0,
            'curr' => $this->curr,
        ];
        return view('person.user.index', $result);
    }

    public function getHead()
    {
        $result = [
            'curr' => $this->curr,
        ];
        return view('person.user.edithead', $result);
    }

    public function setHead(Request $request)
    {
        if (!isset($request->head)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        $oldThumbArr = array();
        $apiUser = ApiUsers::getOneUser(Session::get('user.uid'));
        if ($apiUser['code']==0 && $apiUser['data']['head']) {
            $oldThumbArr[] = $apiUser['data']['head'];
        }
        $thumb = $this->uploadOnlyImg($request,'head',$oldThumbArr);
        $apiUser2 = ApiUsers::setHead($this->userid,$thumb);
        if ($apiUser2['code']!=0) {
            echo "<script>alert('".$apiUser2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/user');
    }

    public function edit()
    {
        $result = [
            'curr' => $this->curr,
        ];
        return view('person.user.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiUsers::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/user');
    }

    public function getPwd()
    {
        $result = [
            'curr' => $this->curr,
        ];
        return view('person.user.editpwd', $result);
    }

    public function setPwd(Request $request,$id)
    {
        if (!$request->oldpwd || !$request->newpwd || !$request->newpwd2) {
            echo "<script>alert('2密码不能空！');history.go(-1);</script>";exit;
        }
        $rstUser = ApiUsers::getOneUser($this->userid);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        //查看2次密码输入是否一致
        if ($request->newpwd!=$request->newpwd2) {
            echo "<script>alert('2次老密码输入不一致！');history.go(-1);</script>";exit;
        }
        //验证密码正确否
        if (!(Hash::check($request->oldpwd,$rstUser['data']['password']))) {
            echo "<script>alert('老密码错误！');history.go(-1);</script>";exit;
        }
        $data = [
            'id'    =>  $id,
            'newpwdhash'    =>  Hash::make($request->newpwd),
            'newpwd'        =>  $request->newpwd,
        ];
        $rst = ApiUsers::modifyPwd($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        //去除session
        Session::forget('user');
        return redirect(DOMAIN.'login');
    }





    public function getData(Request $request)
    {
        if (!$request->username) { echo "<script>alert('用户名必填！');history.go(-1);</script>";exit; }
        if (strlen($request->username)<2 || strlen($request->username)>20) {
            echo "<script>alert('用户名要求2-20个字符！');history.go(-1);</script>";exit;
        }
        return array(
            'username' => $request->username,
//            'email' => $request->email,
            'qq' => $request->qq,
            'tel' => $request->tel,
            'mobile' => $request->mobile,
//            'area' => $request->area,
            'address' => $request->address,
        );
    }

    /**
     * 好友数量
     */
    public function frields()
    {
        $rst = ApiPerson::getUserFrields($this->userid,$this->limit);
        return $rst['code']==0 ? $rst['data'] : [];
    }

    /**
     * 会员签到情况
     */
    public function signs()
    {
        $date = date('Ym',time());     //当前月份
        $fromdate = $date.'01000000';        //当前月初
        //推算月份
        $yuefen = ltrim(date('m',time()),'0');
        if ($yuefen==2) {
            $month = date('Y',time())%4==0 ? 29 : 28;
        } elseif (in_array($yuefen,[1,3,5,7,8,10,12])) {
            $month = 31;
        } elseif (in_array($yuefen,[4,6,9,11])) {
            $month = 30;
        }
        $todate = isset($month)?$date.$month.'240000':$date.'00240000';
        $rstSign = ApiSign::signAll($this->userid);     //签到总数
//        $rstUserParam = ApiUsers::getParamByUid($this->userid);
//        $userParam = $rstUserParam['code']==0?$rstUserParam['data']:[];
        if ($rstSign['code']==0) {
            $rewardCount = 0;
            foreach ($rstSign['data'] as $value) { $rewardCount += $value['reward']; }
        }
        //当月签到情况
        $rstSignsMonth = ApiSign::getSignsByUid($this->userid,strtotime($fromdate),strtotime($todate));
        //当天签到情况
        $fromday = date('Ymd', time()).'000000';    //当天凌晨0点
        $today = date('Ymd', time()).'240000';    //当天夜里24点
        $rstSignsDay = ApiSign::getSignsByUid($this->userid,strtotime($fromday),strtotime($today));
        $datas['day'] = $date?1:0;
        return array(
            'signs' =>  $rstSign['code']==0?$rstSign['data']:[],
            'signsMonth'    =>  $rstSignsMonth['code']==0?$rstSignsMonth['data']:[],
            'rewardCount'   =>  isset($rewardCount)?$rewardCount:0,
            'signsDay'      =>  ($rstSignsDay['code']==0&&count($rstSignsDay['data']))?1:0,
        );
    }

    /**
     * 获取用户注册日志
     */
    public function firstLog()
    {
        $rstLog = ApiLog::getRegistLog($this->userid);
        return $rstLog['code']==0 ? $rstLog['data'] : [];
    }

    /**
     * 获取前一次用户访问日志
     */
    public function lastLog()
    {
        $rstLog = ApiLog::getlastLog($this->userid);
        return $rstLog['code']==0 ? $rstLog['data'] : [];
    }
}