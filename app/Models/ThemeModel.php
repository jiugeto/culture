<?php
namespace App\Models;

class ThemeModel extends BaseModel
{
    protected $table = 'bs_theme';
    protected $fillable = [
        'id','name','intro','uid','uname','sort','isshow','created_at','updated_at',
    ];

    public function getUserName()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userName = '';
        if ($uid) {
            $userModel = UserModel::find($uid);
            $userName = $userModel?$userModel->username:'';
        }
        return $userName ? $userName : '本站';
    }
}