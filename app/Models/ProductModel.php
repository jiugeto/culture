<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\ProductAttrModel;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','intro','uid','uname','css_id','js_id','del','created_at','updated_at',
    ];

//    /**
//     * css样式，js文件
//     */
//    public function type()
//    {
//        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
//    }

    /**
     * 由css_id得到一条css记录
     */
    public function getOneCss($css_id)
    {
        return ProductAttrModel::where('id', $css_id)->first();
    }

    /**
     * 由js_id得到一条js记录
     */
    public function getOneJs($js_id)
    {
        return ProductAttrModel::where('id', $js_id)->first();
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