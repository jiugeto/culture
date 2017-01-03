<?php
namespace App\Models;

class RentPicModel extends BaseModel
{
    protected $table = 'bs_rent_pic';
    protected $fillable = [
        'id','rent_id','link','created_at',
    ];
}