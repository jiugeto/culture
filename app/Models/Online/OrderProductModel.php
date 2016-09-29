<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;
use App\Models\Base\PayModel;

class OrderProductModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders_pro';
    protected $fillable = [
        'id','productid','serial','seller','sellerName','buyer','buyerName','record','format','status','isshow','created_at','updated_at',
    ];
    //视频格式
    protected $formatNames = [
        1=>'标清(720*405)','小高清(1280*720)','高清(1920*1080)',
    ];
    protected $formatMoneys = [
        1=>20,40,60,
    ];

//    protected $statuss = [
//        1=>''
//    ];

    //得到创作订单信息
    public function getProductName()
    {
        $product = ProductModel::find($this->productid);
        return isset($product) ? $product->name : '';
    }

//    public function statusName()
//    {
//        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
//    }

    /**
     * 获取对应支付信息
     */
    public function getPay()
    {
        $payModel = PayModel::where('genre',3)
            ->where('order_id',$this->id)
            ->first();
        return $payModel ? $payModel : '';
    }

    /**
     * 获取对应支付金额
     */
    public function getMoney()
    {
        return $this->getPay() ? $this->getPay()->money() : '';
    }
}