<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\PicModel;

class ComFuncModel extends BaseModel
{
    /**
     * 企业模块
     */

    protected $table = 'com_funcs';
    protected $fillable = [
        'id','name','cid','module_id','genre','pic_id','intro','small','sort','isshow','created_at','updated_at',
    ];
    protected $genres = [
        1=>'默认模块','新加单页'
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid)->name : '无';
    }

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '无';
    }

    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '无';
    }

    public function pic()
    {
        return $this->pic_id ? PicModel::find($this->pic_id) :'无';
    }

    public function module()
    {
        return $this->module_id ? ComModuleModel::find($this->module_id)->name : '无';
    }
}