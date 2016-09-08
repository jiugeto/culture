<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class LogModel extends BaseModel
{
    /**
     * 这是管理员日志表
     */

    protected $table = 'ba_log';
    protected $fillable = [
        'id','uid','uname','genre','action','serial','ip','ipaddress','loginTime','logoutTime',
    ];
    protected $genres = [
        1=>'用户记录','管理员记录',
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