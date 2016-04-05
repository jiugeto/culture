<?php
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','email','qq','tel','mobile','isauth','emailck','pid','cid','isauth','created_at','updated_at',
    ];
}