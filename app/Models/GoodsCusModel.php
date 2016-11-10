<?php
namespace App\Models;

class GoodsCusModel extends BaseModel
{
    /**
     * 客户作品定制表
     */

    protected $table = 'bs_goodsCus';
    protected $fillable = [
        'id','name','intro','uid','money1','supply','money2','created_at','updated_at',
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
    public function getGoodCustoms()
    {
        return GoodsCusUserModel::where('cus_id',$this->id)->get();
    }

    /**
     * 确定供应方信息
     */
   public function getSupplyName()
   {
       $userModel = UserModel::find($this->supply);
       return $userModel ? $userModel->username : '未定';
   }

    /**
     * 片源确定价格
     */
    public function getMoney2()
    {
        return $this->money2 ? $this->money1.'元' : '未定';
    }

    /**
     * 确定状态
     */
    public function getStatusName()
    {
        if (!$this->supply || !$this->money2) {
            $statusName = '未定';
        } else {
            $statusName = '交易中';
        }
        return $statusName;
    }
}