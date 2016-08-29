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
    //功能类型：1公司，2服务，3团队，4招聘，5联系，6其他单页
    protected $genres = [
        1=>'公司','服务','团队','招聘','联系','其他单页',
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid)->cname : '本站';
    }

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '';
    }

    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
    }
}