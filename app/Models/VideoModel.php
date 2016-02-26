<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class VideoModel extends BaseModel
{
    protected $table = 'bs_videos';
    protected $fillable = [
        'id','name','cate_id','intro','link','uid','uname','del','created_at','updated_at',
    ];

    /**
     * 分类关联
     */
   public function cate()
   {
       return $this->hasOne('App\Models\VideoCategoryModel','id','cate_id');
   }
}