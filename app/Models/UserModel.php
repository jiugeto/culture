<?php
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','email','qq','tel','mobile','isauth','emailck','isuser','isvip','isauth','created_at','updated_at',
    ];

    protected $isusers = [
        1=>'个人消费者','普通企业','设计师','广告公司','影视公司','租赁公司',
    ];

    public function isuser()
    {
        return $this->isuser ? $this->isusers[$this->isuser] : '';
    }
}