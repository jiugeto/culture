<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksModel extends BaseModel
{
    protected $table = 'bs_talks';
    protected $fillable = [
        'id','name','content','uid','read','sort','isshow','del','created_at','updated_at',
    ];

    /**
     * 关注话题
     */
    public function follow()
    {
        return TalksFollowModel::where('talkid',$this->id)->get();
    }

    /**
     * 分享话题
     */
    public function share()
    {
        return TalksShareModel::where('talkid',$this->id)->get();
    }

    /**
     * 举报话题
     */
    public function report()
    {
        return TalksReportModel::where('talkid',$this->id)->get();
    }

    /**
     * 收集话题
     */
    public function collect()
    {
        return TalksCollectModel::where('talkid',$this->id)->get();
    }

    /**
     * 感谢话题
     */
    public function thank()
    {
        return TalksThankModel::where('talkid',$this->id)->get();
    }

    /**
     * 点赞话题
     */
    public function click()
    {
        return TalksClickModel::where('talkid',$this->id)->get();
    }

//    public function followStr()
//    {
//        if ($this->follow()) { foreach ($this->follow() as $v) { $follows = $v->followid; } }
//        return isset($follows) ? count($follows) : 0;
//    }
//
//    public function shareStr()
//    {
//        if ($this->share()) { foreach ($this->share() as $v) { $shares = $v->shareid; } }
//        return isset($shares) ? count($shares) : 0;
//    }
//
//    public function reportStr()
//    {
//        if ($this->report()) { foreach ($this->report() as $v) { $reports = $v->reportid; } }
//        return isset($reports) ? count($reports) : 0;
//    }
//
//    public function collectStr()
//    {
//        if ($this->collect()) { foreach ($this->collect() as $v) { $collects = $v->collectid; } }
//        return isset($collects) ? count($collects) : 0;
//    }
//
//    public function thankStr()
//    {
//        if ($this->thank()) { foreach ($this->thank() as $v) { $thanks = $v->thankid; } }
//        return isset($thanks) ? count($thanks) : 0;
//    }
//
//    public function clickStr()
//    {
//        if ($this->click()) { foreach ($this->click() as $v) { $clicks = $v->clickid; } }
//        return isset($clicks) ? count($clicks) : 0;
//    }

    public function areatoname()
    {
        $userInfo = UserModel::find($this->uid);
        return $userInfo->area ? AreaModel::find($userInfo->area)->cityname : '未知城市';
    }
}