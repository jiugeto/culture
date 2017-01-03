<?php
namespace App\Models\Base;

use App\Models\BaseModel;

class AdPlaceModel extends BaseModel
{
    protected $table = 'bs_ad_places';
    protected $fillable = [
        'id','name','plat','intro','uid','width','height','price','number','created_at','updated_at',
    ];
    protected $plats = [
        1=>'网站前台','公司前台',
    ];

    public function getPlat()
    {
        return $this->plats[$this->plat];
    }
}