<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class GoodsModel extends BaseModel
{
    /**
     * goods 商品、货物，代表文化类产品
     */

    protected $table = 'bs_goods';
    protected $fillable = [
        'id','name','type','cate_id','intro','link_id','uid','uname','del','created_at','updated_at',
    ];
}