<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TypeModel;

class ProductAttrModel extends Model
{
    protected $table = 'bs_products_attr';
    public $timestamps = false;
    protected $fillable = [
        'id','name','type_id','url','intro','created_at','updated_at',
    ];

//    /**
//     * 关联类型表
//     */
//    public function type()
//    {
//        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
//    }

    /**
     * 关联类型表
     */
    public function getTypes()
    {
        return TypeModel::where([
                    'table_name'=>'bs_products_attr',
                    'field'=>'type_id'
                ])
                    ->get();
    }
}