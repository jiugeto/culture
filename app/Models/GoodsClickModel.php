<?php
namespace App\Models;

class GoodsClickModel extends BaseModel
{
    /**
     * 这是视频点击表 model
     */

    protected $table = 'bs_goods_click';
    protected $fillable = [
        'id','gid','uid','created_at',
    ];
}