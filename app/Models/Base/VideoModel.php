<?php
namespace App\Models\Base;

use App\Models\UserParamsModel;

class VideoModel extends BaseModel
{
    protected $table = 'bs_videos';
    protected $fillable = [
        'id','uid','name','url','url2','pic_id','intro','del','created_at','updated_at',
    ];

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
        $userParam = UserParamsModel::find($uid);
        return $userParam ? $userParam->leplay : 0;
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

    public function pic()
    {
        $pic_id = $this->pic_id ? $this->pic_id : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->url : '';
    }

    public function getPicName()
    {
        return $this->pic() ? $this->pic()->name : '';
    }
}