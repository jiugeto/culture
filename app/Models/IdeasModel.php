<?php
namespace App\Models;

class IdeasModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'bs_ideas';
    protected $fillable = [
        'id','name','cate_id','content','uid','read','click','sort','del','created_at','updated_at',
    ];

//    public function categorys()
//    {
//        return CategoryModel::all();
//    }

    /**
     * 得到所有分类
     */
    public function categorys()
    {
        $categorys =  CategoryModel::where('del',0)->get();
//        $categorys = Tools::category($categorys);
        $categorys = \App\Tools::getChild($categorys);
        return $categorys;
    }

    public function cate()
    {
        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
    }
}