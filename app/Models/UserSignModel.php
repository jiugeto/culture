<?php
namespace App\Models;

class UserSignModel extends BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_user_sign';
    protected $fillable = [
        'id','uid','created_at','updated_at',
    ];
}