<?php
namespace App\Models\Base;

class UserWalletModel extends BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_user_wallet';
    protected $fillable = [
        'id','uid','sign','gold','weal','created_at','updated_at',
    ];

//    /**
//     * 用户名称
//     */
//    public function getUName()
//    {
//        return $this->uid ? $this->getUserName($this->uid) : '';
//    }
}