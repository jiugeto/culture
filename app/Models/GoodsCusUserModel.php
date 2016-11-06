<?php
namespace App\Models;

class GoodsCusUserModel extends BaseModel
{
    /**
     * 客户作品定制竞选表
     */

    protected $table = 'bs_goodsCus_users';
    protected $fillable = [
        'id','cus_id','uid','link','intro','money','created_at','updated_at',
    ];

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
}