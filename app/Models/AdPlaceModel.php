<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPlaceModel extends Model
{
    protected $table = 'bs_ad_places';
    public $timestamps = false;
    protected $fillable = [
        'id','name','intro','type_id','uid','width','height','price','number','del','created_at','updated_at',
    ];

    /**
     * 广告位
     */
    public function type()
    {
        return $this->hasOne('App\Models\TypeModel','id','type_id');
    }

    /**
     * 类别关联 表id==3
     */
    public function getTypes()
    {
        return TypeModel::where([
            'table_id'=> 3,
            'field'=> 'type_id',
        ])
            ->get();
    }
}