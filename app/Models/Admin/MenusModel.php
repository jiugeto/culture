<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class MenusModel extends BaseModel
{
    protected $table = 'bs_menus';
    protected $fillable = [
        'id','name','type','intro','namespace','controller_prefix','url','action','style_class','pid','created_at','updated_at',
    ];
    protected $types = [
        1=>'会员后台member',2=>'个人后台person',3=>'企业后台company',
    ];

    public function parent()
    {
        return $this->belongsTo($this, 'pid');
    }
}