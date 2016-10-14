<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;
use App\Models\Base\VideoModel;

class ProductVideoModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','cate','intro','video_id','link','uid','created_at','updated_at',
    ];
    protected $genres = [
        1=>'动画定制','效果定制',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function genre()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getVideo()
    {
        $videoModel = VideoModel::find($this->video_id);
        return $videoModel ? $videoModel : '';
    }
}