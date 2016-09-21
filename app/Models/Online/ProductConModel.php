<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductConModel extends BaseModel
{
    /**
     * 产品动画的图片文字管理
     */

    protected $table = 'bs_pro_con';
    protected $fillable = [
        'id','genre','pic_id','name','attrid','sort','created_at','updated_at',
    ];
    protected $genres = [
        1=>'图片','文字'
    ];
}