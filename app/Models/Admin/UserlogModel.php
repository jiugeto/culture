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
        'id','uid','uname','serial','ip','loginTime','logoutTime','created_at',
    ];

    public function loginTime()
    {
        return $this->loginTime ? date("Y年m月d日 H:i", $this->loginTime) : '';
    }

    public function logoutTime()
    {
        return $this->logoutTime ? date("Y年m月d日 H:i", $this->logoutTime) : '非正常退出';
    }
}