<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class UserlogModel extends BaseModel
{
    /**
     * 这是用户日志表model
     */

    protected $table = 'ba_userlog';
    protected $fillable = [
        'id','plat','uid','uname','serial','loginTime','logoutTime','created_at',
    ];
}