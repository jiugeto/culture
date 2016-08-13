<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class AdPlaceModel extends BaseModel
{
    protected $table = 'bs_ad_places';
    protected $fillable = [
        'id','name','intro','type_id','uid','width','height','price','number','del','created_at','updated_at',
    ];
}