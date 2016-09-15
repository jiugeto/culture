<?php
namespace App\Models\Base;

class AdModel extends BaseModel
{
    protected $table = 'bs_ads';
    protected $fillable = [
        'id','name','adplace_id','intro','pic_id','link','fromTime','toTime','uid','isauth','isshow','isuse','created_at','updated_at',
    ];
    protected $isauths = [
        1=>'未审核','未通过审核','通过审核',
    ];

    /**
     * 所有广告位
     */
    public function adplaces()
    {
        return AdPlaceModel::all();
    }

    /**
     * 指定用户的所有广告位
     */
    public function userAdplaces($uid=0)
    {
        return AdPlaceModel::where('plat',2)->whereIn('uid',[0,$uid])->get();
    }

    /**
     * 关联广告位
     */
    public function adplace()
    {
        $adplaceModel = AdPlaceModel::find($this->adplace_id);
        return $adplaceModel ? $adplaceModel : '';
    }

    /**
     * 广告位名称
     */
    public function getAdplaceName()
    {
        return $this->adplace() ? $this->adplace()->name : '';
    }

    public function pic()
    {
        $picModel = PicModel::find($this->pic_id);
        return $picModel ? $picModel : '';
    }

    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->getUrl() : '';
    }

    /**
     * 有效开始时间
     */
    public function fromTime()
    {
        return date('Y年m月d日 H:i:s',$this->fromTime);
    }

    /**
     * 有效结束时间
     */
    public function toTime()
    {
        return date('Y年m月d日 H:i:s',$this->toTime);
    }

    /**
     * 审核状态
     */
    public function isauth()
    {
        if ($this->uid) {
            $isauth = array_key_exists($this->isauth,$this->isauths) ? $this->isauths[$this->isauth] : '';
        } else {
            $isauth = '/';
        }
        return $isauth;
    }

    /**
     * 申请使用的企业
     */
    public function getUName()
    {
        if ($this->uid) {
            $uname = $this->getCompanyName($this->uid) ? $this->getCompanyName($this->uid) : $this->getUserName($this->uid);
        } else {
            $uname = '本站';
        }
        return $uname;
    }

    /**
     * 广告有效期
     */
    public function period()
    {
        if ($this->fromTime > time()) {
            $periodName = '未开始';
        } elseif ($this->fromTime < time() && $this->toTime > time()) {
            $periodName = '进行中';
        } elseif ($this->toTime < time()) {
            $periodName = '已过期';
        }
        return isset($periodName) ? $periodName : '';
    }

    public function isshow()
    {
        return $this->isshow ? '显示' : '不显示';
    }

    public function isuse()
    {
        return $this->isuse ? '使用' : '不使用';
    }
}