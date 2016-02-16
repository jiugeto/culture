<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttrModel extends Model
{
    protected $table = 'bs_Products';
    public $timestamps = false;
    protected $fillable = [
        'id','name','type_id','url','intro','created_at','updated_at',
    ];

    /**
     * 关联类型表
     */
    public function type()
    {
        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
    }
}