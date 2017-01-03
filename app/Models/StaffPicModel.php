<?php
namespace App\Models;

class StaffPicModel extends BaseModel
{
    protected $table = 'bs_staff_img';
    protected $fillable = [
        'id','staff_id','link','created_at','updated_at',
    ];
}