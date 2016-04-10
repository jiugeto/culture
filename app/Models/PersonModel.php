<?php
namespace App\Models;

class PersonModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'persons';
    protected $fillable = [
        'id','realname','genre','sex','idcard','idfront','created_at','updated_at',
    ];

    protected $genres = [       //对应users表isuser
        1=>'个人消费者',3=>'设计师',
    ];

    public function genre()
    {
        return $this->genres[$this->genre];
    }
}