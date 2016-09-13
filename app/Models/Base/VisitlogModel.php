<?php
namespace App\Models\Base;

use App\Models\CompanyModel;
use App\Models\UserModel;

class VisitlogModel extends BaseModel
{
    /**
     * 公司页面的用户访问日志
     */

    protected $table = 'bs_visitlog';
    protected $fillable = [
        'id','cid','visit_id','action','ip','ipaddress','serial','dayCount','timeCount','loginTime','logoutTime',
    ];

    /**
     * 访问用户名称
     */
    public function getVisitName()
    {
        $visitid = $this->visit_id ? $this->visit_id : 0;
        $userModel = UserModel::find($visitid);
        return $userModel ? $userModel->username : '游客';
    }

    /**
     * 被访问的企业名称
     */
    public function getCName()
    {
        $cid = $this->cid ? $this->cid : 0;
        $companyModel = CompanyModel::find($cid);
        return $companyModel ? $companyModel->name : '';
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
     * 用户当天访问时长
     */
    public function getTimeCount()
    {
        return $this->timeCount ? $this->timeCount.' 秒' : '不到 '.$visitRate.' 秒';
    }
}