<?php
namespace App\Models\Company;

use App\Models\BaseModel;

class ComMainModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'com_main';
    protected $fillable = [
        'id','uid','cid','name','title','keyword','description','logo','layout_home','sort','istop','isshow','isshow2','created_at','updated_at',
    ];

    //公司首页布局开关：serviceSwitch服务开关，newsSwitch新闻开关，productSwitch产品开关，parternerSwitch合作伙伴，introSwitch公司简介，
    //partSwitch花絮开关，teamSwitch团队开关，recruitSwitch招聘开关，contactSwicth联系开关，pptSwitch宣传栏开关，footLinkSwitch底部链接，
    protected $layoutHomes = [
        1=>'serviceSwitch','newsSwitch','productSwitch','parternerSwitch','introSwitch','partSwitch','teamSwitch','recruitSwitch',
        'contactSwicth','pptSwitch','footLinkSwitch',
    ];

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid) : '';
    }
}