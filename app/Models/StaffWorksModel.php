<?php
namespace App\Models;

class StaffWorksModel extends BaseModel
{
    /**
     * 演员和影视作品（包含电视剧、电影、广告等等）关联表
     */

    protected $table = 'bs_staff_works';
    protected $fillable = [
        'id','staff_id','works_id','created_at','updated_at',
    ];
}