<?php
namespace App\Models;

class ProductLayerModel extends BaseModel
{
    protected $table = 'bs_products_layer';
    protected $fillable = [
        'id','name','attrid','productid','field','per','value','intro','del','created_at','updated_at',
    ];

    public function productAll()
    {
        return ProductModel::all();
    }

    public function products($uid)
    {
        return ProductModel::where('uid',$uid)->get();
    }

    public function product()
    {
        if ($this->productid) {
            $productModel = ProductModel::find($this->productid);
            if ($productModel) { $pname = $productModel->name; }
        }
        return isset($pname) ? $pname : '未知';
    }
}