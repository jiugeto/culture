<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentModel extends Model
{
    protected $table = 'bs_rents';
    protected $fillable = [
        'name','genre','intro','uid','price','del','created_at','updated_at',
    ];
}