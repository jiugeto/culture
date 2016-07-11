<?php
namespace App\Models;

class GoodsLikeModel extends BaseModel
{
    /**
     * 这是视频喜欢表 model
     */

    protected $table = 'bs_goods_like';
    protected $fillable = [
        'id','gid','uid','created_at',
    ];
}