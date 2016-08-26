<?php
namespace App\Models;

class AdPlaceModel extends BaseModel
{
    protected $table = 'bs_ad_places';
    protected $fillable = [
        'id','name','intro','uid','width','height','price','number','created_at','updated_at',
    ];
}