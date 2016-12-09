<?php
namespace App\Models\Base;

use App\Api\ApiUser\ApiUsers;
use App\Models\UserParamsModel;

class VideoModel extends BaseModel
{
    protected $table = 'bs_videos';
    protected $fillable = [
        'id','uid','name','urlSel','url','url2','pic_id','intro','del','created_at','updated_at',
    ];
    protected $urlSels = [
        1=>'乐视视频','腾讯视频','优酷视频',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid) ? $this->getUserName($this->uid) : '系统';
    }

    public function width()
    {
        return $this->width ? $this->width : 640;
    }

    public function height()
    {
        return $this->height ? $this->height : 360;
    }

    public function isplay($uid)
    {
        $uid = $uid ? $uid : 0;
//        $userParam = UserParamsModel::find($uid);
//        return $userParam ? $userParam->leplay : 0;
        $rstParam = ApiUsers::getParamByUid($uid);
        return $rstParam['code']==0 ? $rstParam['data']['leplay'] : 0;
    }

    public function pics($uid=0)
    {
        if ($uid) {
            $picModels = PicModel::where('uid',$uid)->get();
        } else {
            $picModels = PicModel::all();
        }
        return $picModels ? $picModels : [];
    }

    public function getPicUrl()
    {
        return $this->getPic($this->pic_id) ? $this->getPic($this->pic_id) : '';
    }

    public function getPicName()
    {
        return $this->pic($this->pic_id) ? $this->pic($this->pic_id)->name : '';
    }
}