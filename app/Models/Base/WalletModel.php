<?php
namespace App\Models\Base;

class WalletModel extends BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_wallet';
    protected $fillable = [
        'id','uid','sign','gold','tip','weal','created_at','updated_at',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->uid ? $this->getUserName($this->uid) : '';
    }

    /**
     * 设置金币奖励
     */
    public static function setGold($uid,$gold)
    {
        $walletModel = WalletModel::where('uid',$uid)->first();
        $goldCount = $walletModel->gold+$gold;
        WalletModel::where('uid',$uid)->update(['gold'=> $goldCount]);
    }

    /**
     * 判断是否已经支付过
     */
    public function isPay()
    {
        $payModel = PayModel::where('uid',$this->uid)->where('ispay',1)->first();
        return ($payModel||$this->tip||$this->weal) ? 1 : 0;
    }
}