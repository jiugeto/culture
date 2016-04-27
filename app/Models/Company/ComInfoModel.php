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
    //信息类型：1公司介绍，2资质荣誉，3历程，4公司新闻，5行业咨询，6团队
    protected $types = [
        1=>'公司介绍','资质荣誉','历程','公司新闻','行业咨询','团队',
    ];

    public function type()
    {
        return $this->type ? $this->types[$this->type] : '';
    }

    public function company()
    {
        return \App\Models\CompanyModel::find($this->cid);
    }
}