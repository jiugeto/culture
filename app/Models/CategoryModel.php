<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\TypeModel;

class CategoryModel extends BaseModel
{
    protected $table = 'bs_category';
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

    /**
     * 类别依据关联 表id==2
     */
   public function getTypes()
   {
       return TypeModel::where([
                       'table_id'=> 2,
                       'field'=> 'type_id',
                   ])
                   ->get();
   }
}