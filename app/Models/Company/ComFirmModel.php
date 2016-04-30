<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\PicModel;

class ComFirmModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业服务表 model
     */

    protected $table = 'bs_com_firms';
    protected $fillable = [
        'id','name','cid','intro','title','pic_id','detail','small','sort','sort2','isshow','isshow2','created_at','updated_at',
    ];

    public function company()
    {
        return \App\Models\CompanyModel::find($this->cid);
    }

    public function pics()
    {
        return PicModel::all();
    }

    public function pic()
    {
        return $this->pic_id ? PicModel::find($this->pic_id) :'';
    }
}