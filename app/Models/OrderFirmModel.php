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
        'id','orderid','genre','money','status','isshow','del','created_at','updated_at',
    ];

    protected $genres = [
        1=>'创意/分镜/商品','娱乐/演员/租赁',
    ];

    public function order()
    {
        $orderid = $this->orderid ? $this->orderid : 0;
        $orderModel = OrderModel::find($orderid);
        return $orderModel;
    }

    public function genre()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '无';
    }
}