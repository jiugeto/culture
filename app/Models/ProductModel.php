<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\ProductAttrModel;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','gif','intro','uid','uname','width','height','isauth','sort','isshow','del','created_at','updated_at',
    ];
    protected $isauths = [
        '未审核','未通过审核','通过审核',
    ];
}