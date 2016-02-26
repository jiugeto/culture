<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TypeModel extends BaseModel
{
    protected $table = 'bs_types';
    protected $fillable = [
        'id','name','table_id','table_name','field','intro','created_at','updated_at',
    ];
}