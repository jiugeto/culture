<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class PicModel extends BaseModel
{
    protected $table = 'bs_pics';
    protected $fillable = [
        'id','uid','name','url','intro','del','created_at','updated_at',
    ];
}