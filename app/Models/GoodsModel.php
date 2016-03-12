<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class GoodsModel extends BaseModel
{
    protected $table = 'bs_goods';
    protected $fillable = [
        'id','name','type','cate_id','intro','link_id','uid','uname','del','created_at','updated_at',
    ];
}