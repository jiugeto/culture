<?php
namespace App\Models\Base;

class PayModel extends BaseModel
{
    /**
     * 支付表
     */
    protected $table = 'bs_pay';
    protected $fillable = [
        'id','genre','order_id','money','isfine','created_at','updated_at',
    ];

    public function money()
    {
        return $this->money ? $this->money.'元' : 0;
    }
}