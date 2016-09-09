<?php
namespace App\Models\Base;

class VisitlogModel extends BaseModel
{
    /**
     * 公司页面的用户访问日志
     */

    protected $table = 'bs_visitlog';
    protected $fillable = [
        'id','cid','visit_id','action','ip','ipaddress','serial','dayCount','timeCount','loginTime','logoutTime',
    ];
}