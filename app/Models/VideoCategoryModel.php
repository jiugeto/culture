<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoCategoryModel extends Model
{
    protected $table = 'bs_videos_category';
    public $timestamps = false;
    protected $fillable = [
        'id','name','pid','intro','created_at','updated_at',
    ];

    /**
     * 父分类关联
     */
   public function pid()
   {
       return $this->hasOne('App\Models\VideoCategoryModel','id','pid');
   }
}