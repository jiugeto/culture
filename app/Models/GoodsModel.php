<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use App\Tools;

class GoodsModel extends BaseModel
{
    /**
     * goods 商品、货物，代表文化类产品
     */

    protected $table = 'bs_goods';
    protected $fillable = [
        'id','name','type','cate_id','intro','link_id','uid','uname','del','created_at','updated_at',
    ];

    protected $types = [
        //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
        1=>'个人需求','设计师供应','企业需求','企业供应',
    ];

    public function cates()
    {
        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
    }

    /**
     * 得到所有分类
     */
    public function categorys()
    {
        $categorys =  CategoryModel::where('del',0)->get();
//        $categorys = Tools::category($categorys);
        $categorys = Tools::getChild($categorys);
        return $categorys;
    }
}