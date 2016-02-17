<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignModel extends Model
{
    protected $table = 'bs_designs';
    protected $fillable = [
        'name','genre','type_id','uid','intro','price','del','created_at','updated_at',
    ];
}