<?php
namespace App\Models;

class PersonModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'persons';
    protected $fillable = [
        'id','realname','sex','idcard','idfront','uid','created_at','updated_at',
    ];
}