<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdModel extends Model
{
    protected $table = 'bs_ads';
    public $timestamps = false;
    protected $fillable = [
        'id','name','ad_place_id','intro','pic_id','link','fromtime','totime','uid','auth','status','created_at','updated_at',
    ];

    /**
     * 广告位
     */
    public function adPlace()
    {
        return $this->hasOne('App\Models\AdPlaceModel','id','ad_place_id');
    }
}