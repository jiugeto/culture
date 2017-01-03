<?php
namespace App\Models\Base;

use App\Models\BaseModel;

class PayModel extends BaseModel
{
    /**
     * 支付表
     */
    protected $table = 'bs_pay';
    protected $fillable = [
        'id','genre','order_id','money','weal','isfine','ispay','created_at','updated_at',
    ];
    //来自哪一张表
    protected $genres = [
        1=>'订单','售后服务','创作订单',
    ];
    //是否延时赔付
    protected $isfines = [
        1=>'不延时','延时罚款','罚款已到位',
    ];
    //支付宝是否正常收款：未到支付宝，支付宝已收款
    protected $ispays = [
        '未到支付宝或款不对','支付宝已收款',
    ];

    public function money()
    {
        return $this->money ? $this->money.'元' : 0;
    }

    public function weal()
    {
        return $this->weal ? $this->weal.'元' : 0;
    }

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getFineName()
    {
        return array_key_exists($this->isfine,$this->isfines) ? $this->isfines[$this->isfine] : '';
    }

    public function getPayName()
    {
        return array_key_exists($this->ispay,$this->ispays) ? $this->ispays[$this->ispay] : '';
    }
}