<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class UserLevelModel extends BaseModel
{
    protected $table = 'bs_user_lavel';
    protected $fillable = [
        'id','name','intro','created_at','updated_at',
    ];
}