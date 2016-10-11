<?php
namespace App\Models\Base;

class UserWalletModel extends BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_user_wallet';
    protected $fillable = [
        'id','uid','sign','gold','tip','weal','created_at','updated_at',
    ];

//    /**
//     * 用户名称
//     */
//    public function getUName()
//    {
//        return $this->uid ? $this->getUserName($this->uid) : '';
//    }

    public static function setGold($uid,$gold)
    {
        $walletModel = UserWalletModel::where('uid',$uid)->first();
        $goldCount = $walletModel->gold+$gold;
        UserWalletModel::where('uid',$uid)->update(['gold'=> $goldCount]);
    }
}