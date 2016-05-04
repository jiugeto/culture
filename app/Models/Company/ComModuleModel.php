<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComModuleModel extends BaseModel
{
    /**
     * 企业模块
     */

    protected $table = 'com_modules';
    protected $fillable = [
        'id','name','cid','genre','intro','sort','isshow','created_at','updated_at',
    ];
    protected $genres = [
        1=>'默认模块','新加单页'
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid)->cname : '无';
    }

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '无';
    }
}