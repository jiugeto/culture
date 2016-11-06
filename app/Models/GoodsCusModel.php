<?php
namespace App\Models;

class GoodsCusModel extends BaseModel
{
    /**
     * 客户作品定制表
     */

    protected $table = 'bs_goodsCus';
    protected $fillable = [
        'id','name','intro','uid','money1','created_at','updated_at',
    ];

    /**
     * 片源需求的用户名
     */
    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    /**
     * 片源预算
     */
    public function getMoney1()
    {
        return $this->money1 ? $this->money1.'元' : '';
    }

    /**
     * 定制信息
     */
    public function getGoodCustoms($limit)
    {
        return GoodsCusUserModel::where('cus_id',$this->id)->paginate($limit);
    }
}