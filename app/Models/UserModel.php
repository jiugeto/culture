<?php
namespace App\Models;

class UserModel extends BaseModel
{
    protected $table = 'bs_user';
    protected $fillable = [
        'id','name','password','created_at','updated_at',
    ];
}