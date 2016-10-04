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

    /**
     * 得到创作订单信息
     */
    public function getProduct()
    {
        $productModel = ProductModel::find($this->productid);
        return $productModel ? $productModel : '';
    }

    /**
     * 得到创作订单名称
     */
    public function getProductName()
    {
        return $this->getProduct() ? $this->getProduct()->name : '';
    }

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