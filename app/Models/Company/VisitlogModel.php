<?php
namespace App\Models\Company;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;
use App\Models\BaseModel;

class VisitlogModel extends BaseModel
{
    /**
     * 公司页面的用户访问日志
     */

    protected $table = 'com_visitlog';
    protected $fillable = [
        'id','cid','visit_id','action','ip','ipaddress','serial','dayCount','timeCount','loginTime','logoutTime',
    ];

    /**
     * 访问用户名称
     */
    public function getVisitName()
    {
//        $visitid = $this->visit_id ? $this->visit_id : 0;
//        $userModel = UserModel::find($visitid);
//        return $userModel ? $userModel->username : '游客';
        $rstUser = ApiUsers::getOneUser($this->visit_id);
        return $rstUser['code']==0 ? $rstUser['data']['username'] : '';
    }

    /**
     * 被访问的企业名称
     */
    public function getCName()
    {
//        $cid = $this->cid ? $this->cid : 0;
//        $companyModel = CompanyModel::find($cid);
//        return $companyModel ? $companyModel->name : '';
        $rstCompany = ApiCompany::show($this->cid);
        return $rstCompany['code']==0 ? $rstCompany['data']['name'] : '';
    }

    /**
     * 首次访问时间转换
     */
    public function loginTime()
    {
        return $this->loginTime ? date("Y年m月d日 H:i:s", $this->loginTime) : '';
    }

    /**
     * 最后退出时间转换
     */
    public function logoutTime()
    {
        return $this->logoutTime ? date("Y年m月d日 H:i:s", $this->logoutTime) : '未更新';
    }

    /**
     * 用户停留页面
     */
    public function getAction()
    {
        $urls = explode('/',$this->action);
        if (!isset($urls[3])) {
            $action = '公司首页';
        } elseif ($urls[3]=='product') {
            $action = '公司介绍';
        } elseif ($urls[3]=='news') {
            $action = '新闻资讯';
        } elseif ($urls[3]=='product') {
            $action = '产品样片';
        } elseif ($urls[3]=='part') {
            $action = '花絮';
        } elseif ($urls[3]=='video') {
            $action = '视频预览';
        } elseif ($urls[3]=='firm') {
            $action = '服务项目';
        } elseif ($urls[3]=='team') {
            $action = '团队';
        } elseif ($urls[3]=='recruit') {
            $action = '招聘';
        } elseif ($urls[3]=='contact') {
            $action = '联系方式';
        } elseif ($urls[3]=='parterner') {
            $action = '合作伙伴';
        }
        return isset($action) ? $action : '';
    }

    /**
     * 得到访问频率
     */
    public function getVisitRate()
    {
        $rstCompany = ApiCompany::show($this->cid);
        $uid = $rstCompany['code']==0 ? $rstCompany['data']['uid'] : 0;
        $comMainModel = ComMainModel::where('uid',$uid)->first();
        return $comMainModel ? $comMainModel->visitRate : 0;
    }

    /**
     * 用户当天访问时长
     */
    public function getTimeCount()
    {
        return $this->timeCount ? $this->timeCount.' 秒' : '不到 '.$this->getVisitRate().' 秒';
    }
}