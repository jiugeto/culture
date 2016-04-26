<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComInfoModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业信息表 model
     */

    protected $table = 'bs_com_infos';
    protected $fillable = [
        'id','name','cid','type','intro','pic_id','sort','isshow','isshow2','created_at','updated_at',
    ];
}