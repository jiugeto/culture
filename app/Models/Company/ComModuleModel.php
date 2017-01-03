<?php
namespace App\Models\Company;

use App\Api\ApiUser\ApiCompany;
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
    //功能类型：1公司，2服务，3团队，4招聘，5联系，21其他单页
    protected $genres = [
        1=>'公司','服务','团队','招聘','联系',
        //21以上为新的单页模块，21之前是预留的模块
        21=>'新的模块'
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        $rstCompany = ApiCompany::show($this->cid);
        return $rstCompany['code']==0 ? $rstCompany['data']['name'] : '本站';

    }

    public function genre()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow]: '';
    }
}