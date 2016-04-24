<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class PicModel extends BaseModel
{
    protected $table = 'bs_pics';
    protected $fillable = [
        'id','uid','name','cate_id','url','intro','del','created_at',
    ];

    /**
     * 关联类型表
     */
    public function categorys()
    {
        $categorys =  CategoryModel::where('del',0)->get();
        $categorys = \App\Tools::getChild($categorys);
        return $categorys;
    }

    /**
     * 关联类型表
     */
    public function cate()
    {
        return $this->hasOne('App\Models\CategoryModel', 'id', 'cate_id');
    }
}