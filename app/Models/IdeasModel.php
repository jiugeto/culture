<?php
namespace App\Models;

class IdeasModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'bs_ideas';
    protected $fillable = [
        'id','name','cate_id','content','uid','sort','isshow','del','created_at','updated_at',
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

    public function read()
    {
        return IdeasReadModel::where('ideaid',$this->id)->get();
    }

    public function click()
    {
        return IdeasClickModel::where('ideaid',$this->id)->get();
    }

    public function collect()
    {
        return IdeasCollectModel::where('ideaid',$this->id)->get();
    }
}