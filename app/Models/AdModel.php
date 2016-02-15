<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdModel extends Model
{
    protected $table = 'bs_ad';
    public $timestamps = false;
    protected $fillable = [
        'id','name','intro','namespace','controller_prefix','action','style_class','pid','created_at','updated_at',
    ];
}