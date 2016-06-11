<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OrderFirmModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders_firm';
    protected $fillable = [
        'id','name','orderid','genre','seller','sellerName','buyer','buyerName','money','status','isshow','del','created_at','updated_at',
    ];

    protected $genres = [
        1=>'创意/分镜/商品','娱乐/演员/租赁',
    ];
    protected $statuss = [
        1=>'新申请','拒绝','同意','开始办理','完成办理','确定完成','交易成功','交易失败',
    ];

    public function order()
    {
        $orderid = $this->orderid ? $this->orderid : 0;
        $orderModel = OrderModel::find($orderid);
        return isset($orderModel) ? $orderModel : '';
    }

    public function genre()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '无';
    }

    public function status()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '无';
    }
}