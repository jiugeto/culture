<?php
namespace App\Models;

class GoodsCusUserModel extends BaseModel
{
    /**
     * 客户作品定制竞选表
     */

    protected $table = 'bs_goodsCus_users';
    protected $fillable = [
        'id','cus_id','uid','link','intro','money','makeTime','created_at','updated_at',
    ];

    /**
     * 片源需求的用户名
     */
    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    /**
     * 定制片源信息
     */
    public function getGoodCustom()
    {
        return GoodsCusModel::find($this->cus_id);
    }

    /**
     * 片源名称
     */
    public function getGoodCusName()
    {
        return $this->getGoodCustom() ? $this->getGoodCustom()->name : '';
    }

    /**
     * 制作周期
     */
    public function getPeriod()
    {
        return $this->makeTime ? $this->makeTime.'天' : '';
    }

    /**
     * 制作报价
     */
    public function getMoney()
    {
        return $this->money ? $this->money.'元' : '';
    }
}