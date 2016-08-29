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
        'id','name','cid','module_id','type','pic_id','intro','small','sort','isshow','created_at','updated_at',
    ];
    //功能类型：1简介，2历程，3新闻，4资讯，5服务，6团队，7招聘，8联系，单页
    protected $types = [
        1=>'简介','历程','新闻','资讯','服务','团队','招聘','联系',
        21=>'单页'
    ];
    protected $isshows = [
        '不显示','显示'
    ];

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid)->name : '';
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
        return $this->pic_id ? PicModel::find($this->pic_id) :'';
    }

    /**
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->url : '';
    }

    public function module()
    {
        return $this->module_id ? ComModuleModel::find($this->module_id)->name : '';
    }

    public function moduleModel()
    {
        return $this->module_id ? ComModuleModel::find($this->module_id) : '';
    }

    public function small()
    {
        return $this->small ? explode('|',$this->small) : '';
    }

    public function singelModules($cid=null)
    {
        if (!$cid) { $cid = 0; }
        return \App\Models\Company\ComModuleModel::where('genre',2)->where('cid',$cid)->get();
    }
}