<?php
namespace App\Models;

class TalksModel extends BaseModel
{
    protected $table = 'bs_talks';
    protected $fillable = [
        'id','name','content','uid','uname','read','pid','sort','isshow','del','created_at','updated_at',
    ];

    /**
     * 话题的主题
     */
    public function theme()
    {
        $themeid = $this->themeid ? $this->themeid : 0;
        $themeModel = ThemeModel::find($themeid);
        return $themeModel ? $themeModel : '';
    }

    /**
     * 话题的主题标题
     */
    public function getThemeName()
    {
        return $this->theme() ? $this->theme()->name : '';
    }

    /**
     * 发布人信息
     */
    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    /**
     * 发布人名称
     */
    public function getUserName()
    {
        return $this->user() ? $this->user()->username : '';
    }

    /**
     * 点击话题
     */
    public function click()
    {
        $datas = TalksClickModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    /**
     * 关注话题
     */
    public function follow()
    {
        $datas = TalksFollowModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    /**
     * 分享话题
     */
    public function share()
    {
        $datas = TalksShareModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    /**
     * 举报话题
     */
    public function report()
    {
        $datas = TalksReportModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    /**
     * 收集话题
     */
    public function collect()
    {
        $datas = TalksCollectModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    /**
     * 感谢话题
     */
    public function thank()
    {
        $datas = TalksThankModel::where('talkid',$this->id)->get();
        return count($datas) ? $datas : 0;
    }

    public function areatoname()
    {
        $userInfo = UserModel::find($this->uid);
        $areaName = $userInfo->area ? $this->getAreaName($userInfo->area) : '';
//        return $userInfo->area ? AreaModel::find($userInfo->area)->cityname : '未知城市';
        return $areaName ? $areaName : '未知城市';
    }

    public function parent()
    {
        $pid = $this->pid ? $this->pid : 0;
        $parent = TalksModel::find($pid);
        return $parent ? $parent : '';
    }
}