<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UserLevelModel extends Model
{
    protected $table = 'bs_user_lavel';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];
}