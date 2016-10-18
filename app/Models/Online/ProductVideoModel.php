<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;
use App\Models\Base\VideoModel;

class ProductVideoModel extends BaseModel
{
    protected $table = 'bs_pro_videos';
    protected $fillable = [
        'id','name','genre','cate','intro','gif','video_id','link','uid','created_at','updated_at',
    ];
    protected $genres = [
        1=>'动画定制','效果定制',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getCate()
    {
        return array_key_exists($this->cate,$this->cates2) ? $this->cates2[$this->cate] : '';
    }

    /**
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->getPic($this->gif);
    }

    /**
     * 获取图片名称
     */
    public function getPicName()
    {
        return $this->pic($this->gif) ? $this->pic($this->gif)->name : '';
    }

    public function getVideo()
    {
        $videoModel = VideoModel::find($this->video_id);
        return $videoModel ? $videoModel : '';
    }
}