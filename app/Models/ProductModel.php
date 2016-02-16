<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttrModel;

class ProductModel extends Model
{
    protected $table = 'bs_Products';
    public $timestamps = false;
    protected $fillable = [
        'id','name','intro','uid','css_id','js_id','del','created_at','updated_at',
    ];

    /**
     * css样式，js文件
     */
    public function type()
    {
        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
    }

    /**
     * css样式列表
     */
    public function cssList()
    {
        //假如1代表css
        return ProductAttrModel::where('type_id', 1)->get();
    }

    /**
     * js文件列表
     */
    public function jsList()
    {
        //假如2代表js
        return ProductAttrModel::where('type_id', 2)->get();
    }
}