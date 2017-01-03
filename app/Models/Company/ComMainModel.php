<?php
namespace App\Models\Company;

use App\Api\ApiUser\ApiCompany;
use App\Models\BaseModel;

class ComMainModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'com_main';
    protected $fillable = [
        'id','uid','name','title','keyword','description','logo','layout_home','skin','sort','istop','isshow','created_at','updated_at',
    ];

    //公司首页布局开关：serviceSwitch服务开关，newsSwitch新闻开关，productSwitch产品开关，parternerSwitch合作伙伴，introSwitch公司简介，
    //partSwitch花絮开关，teamSwitch团队开关，recruitSwitch招聘开关，contactSwicth联系开关，pptSwitch宣传栏开关，footLinkSwitch底部链接，
    protected $layoutHomes = [
        1=>'serviceSwitch','newsSwitch','productSwitch','parternerSwitch','introSwitch','partSwitch','teamSwitch','recruitSwitch',
        'contactSwicth','pptSwitch','footLinkSwitch',
    ];
    protected $layoutHomeNames = [
        1=>'服务开关','新闻开关','产品开关','合作伙伴','公司简介','花絮开关','团队开关','招聘开关',
        '联系开关','宣传开关','底部链接',
    ];

    //公司首页皮肤颜色：#333333深灰，#000000黑色，#660000，#226600，#3333ff深蓝，#803600深橙，#9933cc紫色，#440066深紫色，
    protected $skins = [
        1=>'#333333','#000000','#660000','#226600','#003399','#804000','#9933cc','#440066',
    ];
    protected $skinNames = [
        1=>'深灰色','黑色','深红色','深绿色','深蓝色','深橙色','紫色','深紫色',
    ];
    protected $isshows = [
        1=>'不显示','显示'
    ];
    protected $istops = [
        '不置顶','置顶'
    ];

    public function getSkin()
    {
        return $this->skins[$this->skin];
    }

    public function getSkinName()
    {
        return $this->skinNames[$this->skin];
    }

    public function company()
    {
        $rst = ApiCompany::show($this->cid);
        return $rst['code']==0 ? $rst['data'] : [];
    }

    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    public function istop()
    {
        return array_key_exists($this->istop,$this->istops) ? $this->isshows[$this->isshow] : '';
    }
}