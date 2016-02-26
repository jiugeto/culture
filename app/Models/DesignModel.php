<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class DesignModel extends BaseModel
{
    protected $table = 'bs_designs';
    protected $fillable = [
        'id','name','genre','type_id','uid','intro','price','fromtime','totime','del','created_at','updated_at',
    ];
}