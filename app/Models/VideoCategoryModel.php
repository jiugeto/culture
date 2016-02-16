<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TypeModel;

class VideoCategoryModel extends Model
{
    protected $table = 'bs_videos_category';
    public $timestamps = false;
    protected $fillable = [
        'id','name','type_id','pid','intro','created_at','updated_at',
    ];

    /**
     * 父分类关联
     */
   public function pid()
   {
       return $this->hasOne('App\Models\VideoCategoryModel','id','pid');
   }

    /**
     * 类别依据关联
     */
   public function getTypes()
   {
       return TypeModel::where([
                       'table_name'=> 'bs_videos_category',
                       'field'=> 'type_id',
                   ])
                   ->get();
   }
}