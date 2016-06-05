<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OrderProductModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders_pro';
    protected $fillable = [
        'id','productid','serial','seller','sellerName','buyer','buyerName','money','status','isshow','del','created_at','updated_at',
    ];

    public function product()
    {
        $product = ProductModel::find($this->productid);
        return isset($product) ? $product->name : '';
    }
}