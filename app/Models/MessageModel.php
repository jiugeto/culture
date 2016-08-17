<?php
namespace App\Models;

class MessageModel extends BaseModel
{
    protected $table = 'bs_message';
    protected $fillable = [
        'id','title','genre','intro','sender','sender_time','accept','accept_time','status','del','created_at','updated_at',
    ];

    protected $genres = [
        1=>'个人消息','企业消息',
    ];

    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userInfo = UserModel::find($uid);
        return $userInfo ? $userInfo : '';
    }

    public function userName()
    {
        return $this->user() ? $this->user()->username : '';
    }
}