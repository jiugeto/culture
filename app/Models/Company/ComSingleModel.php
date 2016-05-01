<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\PicModel;

class ComSingleModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业单页表 model
     */

    protected $table = 'bs_com_singles';
    protected $fillable = [
        'id','name','cid','cate','intro','sort','sort2','isshow','isshow2','created_at','updated_at',
    ];

    public function company()
    {
        return \App\Models\CompanyModel::find($this->cid);
    }
}