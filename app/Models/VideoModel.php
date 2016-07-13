<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class VideoModel extends BaseModel
{
    protected $table = 'bs_videos';
    protected $fillable = [
        'id','uid','name','url','url2','intro','del','created_at','updated_at',
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
}