<?php
namespace App\Models;

class UserGoldModel extends BaseModel
{
    /**
     * 这是用户金币表
     */

    protected $table = 'bs_user_gold';
    protected $fillable = [
        'id','uid','gold','created_at','updated_at',
    ];
}