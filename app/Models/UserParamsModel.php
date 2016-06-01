<?php
namespace App\Models;

class UserParamsModel extends BaseModel
{
    /**
     * 这是用户参数表 model
     */

    protected $table = 'users_params';
    protected $fillable = [
        'id','uid','limit','foot_switch','created_at','updated_at',
    ];
}