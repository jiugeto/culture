<?php
namespace App\Models\Company;

use App\Models\BaseModel;
use App\Models\Base\PicModel;

class ComMainModel extends BaseModel
{
    /**
     * 企业主表 model
     */

    protected $table = 'com_main';
    protected $fillable = [
        'id','uid','cid','name','title','keyword','description','logo','layout_home','skin','sort','istop','isshow','isshow2','created_at','updated_at',
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
        return $this->cid ? \App\Models\CompanyModel::find($this->cid) : '';
    }

    /**
     * 得到公司logo
     */
    public function logo()
    {
        $pic_id = $this->logo ? $this->logo : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    /**
     * 公司logo链接
     */
    public function getLogo()
    {

        return $this->logo() ? $this->logo()->getUrl() : '';
    }

    /**
     * 得到logo图片名称
     */
    public function getPicName()
    {
        return $this->logo() ? $this->logo()->name : '';
    }
}