<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\PicModel;
use App\Models\CompanyModel;

class ComFuncModel extends BaseModel
{
    /**
     * 企业模块
     */

    protected $table = 'com_funcs';
    protected $fillable = [
        'id','name','cid','module_id','type','pic_id','intro','small','sort','isshow','created_at','updated_at',
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
        return $this->cid ? CompanyModel::find($this->cid)->name : '';
    }

    public function type()
    {
        return $this->type ? $this->types[$this->type] : '';
    }

    public function genre()
    {
        return $this->type<21 ? '默认模块' : '新加单页';
    }


    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
    }

    public function pic()
    {
        $pic_id = $this->pic_id ? $this->pic_id : 0;
        return $this->pic_id ? PicModel::find($pic_id) :'';
    }

    /**
     * 获取图片名称
     */
    public function getPicName()
    {
        return $this->pic() ? $this->pic()->name : '';
    }

    /**
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->url : '';
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