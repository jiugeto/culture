<?php
namespace App\Models\Company;

use App\Api\ApiUser\ApiCompany;
use App\Models\BaseModel;
use App\Models\Base\PicModel;
use App\Models\CompanyModel;

class ComFuncModel extends BaseModel
{
    /**
     * 企业模块
     */

    protected $table = 'com_funcs';
    protected $fillable = [
        'id','name','cid','module_id','type','img','intro','small','sort','isshow','created_at','updated_at',
    ];
    //功能类型：1简介，2历程，3新闻，4资讯，5服务，6团队，7招聘，单页
    protected $types = [
        1=>'简介','历程','新闻','资讯','服务','团队','招聘',
        21=>'单页'
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        $rstCompany = ApiCompany::show($this->cid);
        return $rstCompany['code']==0 ? $rstCompany['data']['name'] : '';
    }

    public function type()
    {
        return array_key_exists($this->type,$this->types) ? $this->types[$this->type] : '';
    }

    public function genre()
    {
        return $this->type<21 ? '默认模块' : '新加单页';
    }


    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    public function small()
    {
        return $this->small ? explode('|',$this->small) : '';
    }

    public function singelModules($cid=null)
    {
        if (!$cid) { $cid = 0; }
        return ComModuleModel::where('genre','>',20)->whereIn('cid',[0,$cid])->get();
    }

    /**
     * 该用户的公司页面模块
     */
    public function getModules()
    {
        return ComModuleModel::whereIn('cid',[0,$this->cid])->where('isshow',1)->get();
    }

    /**
     * 得到对应模块
     */
    public function getModule()
    {
        $module_id = $this->module_id ? $this->module_id : 0;
        $moduleModel = ComModuleModel::find($module_id);
        return $moduleModel ? $moduleModel : '';
    }

    /**
     * 得到对应模块的名称
     */
    public function getModuleName()
    {
        return $this->getModule() ? $this->getModule()->name : '';
    }

    /**
     * 得到对应模块的介绍
     */
    public function getModuleIntro()
    {
        return $this->getModule() ? $this->getModule()->intro : '';
    }
}