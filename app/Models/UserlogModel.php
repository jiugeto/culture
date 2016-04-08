<?php
namespace App\Models;

class UserlogModel extends BaseModel
{
    /**
     * 这是用户日志表model
     */

    protected $table = 'bs_userlog';
    protected $fillable = [
        'id','plat','uid','uname','serial','loginTime','logoutTime','created_at',
    ];
}