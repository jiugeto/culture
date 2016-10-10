<?php
namespace App\Models;

class UserVoiceModel extends BaseModel
{
    protected $table = 'bs_user_voice';
    protected $fillable = [
        'id','name','uid','work','intro','isshow','created_at',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }
}