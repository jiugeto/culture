<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class AreaModel extends BaseModel
{
    protected $table = 'bs_citys';
    protected $fillable = [
        'id','parentid','cityname','nocode','zipcode','weathercode','created_at','updated_at',
    ];
}