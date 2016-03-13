<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\TypeModel;

class CategoryModel extends BaseModel
{
    protected $table = 'bs_category';
    protected $fillable = [
        'id','name','pid','intro','del','created_at','updated_at',
    ];

    /**
     * 父分类关联
     */
   public function pid()
   {
       return $this->hasOne('App\Models\VideoCategoryModel','id','pid');
   }

    /**
     * 分类一级
     */
    public function pidone()
    {
        return CategoryModel::where('del',0)->where('pid',0)->get();
    }
}