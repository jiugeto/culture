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
        'id','productid','serial','uid','uname','record','format','status','isshow','created_at','updated_at',
    ];
    //视频格式
    protected $formatNames = [
        1=>'标清(720*405)','小高清(1280*720)','高清(1920*1080)',
    ];
    protected $formatMoneys = [
        1=>20,40,60,
    ];
    //订单状态：待确定，款不对，待处理，已处理
    protected $statuss = [
        1=>'待确定','未付款或款不对','已付款处理中','已处理',
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

    /**
     * 渲染状态
     */
    public function getStatusName()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
    }

    /**
     * 渲染的格式
     */
    public function getFormatName()
    {
        return array_key_exists($this->format,$this->formatNames) ? $this->formatNames[$this->format] : '';
    }
}