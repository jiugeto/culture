<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    protected $table = 'bs_types';
    public $timestamps = false;
    protected $fillable = [
        'id','name','table_id','table_name','field','intro','created_at','updated_at',
    ];
}