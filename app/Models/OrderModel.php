<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OrderModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_opinions';
    protected $fillable = [
        'id','name','serial','seller','sellerName','buyer','buyerName','number','status','isshow','created_at','updated_at',
    ];
    protected $statuss = [      //订单状态
        '新申请','协商','确定','交易','结果',
    ];
}