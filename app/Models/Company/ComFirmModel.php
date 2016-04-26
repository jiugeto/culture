<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComFirmModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业服务表 model
     */

    protected $table = 'bs_com_firms';
    protected $fillable = [
        'id','name','cid','intro','detail','sort','small1','small2','small3','small4','isshow','isshow2','created_at','updated_at',
    ];
}