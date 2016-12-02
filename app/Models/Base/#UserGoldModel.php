<?php
namespace App\Models\Base;

class UserGoldModel extends BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_user_gold';
    protected $fillable = [
        'id','uid','genre','gold','created_at','updated_at',
    ];
    //金币奖励：1建议发布奖励1-5，2建议评价奖励10-15，3用户心声奖励1-5，4订单好评奖励5，
    protected $genres = [
        1=>'建议发布奖励','建议评价奖励','用户心声奖励','订单好评奖励',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->uid ? $this->getUserName($this->uid) : '';
    }

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function gold()
    {
        return $this->gold ? $this->gold.'个金币' : '';
    }

    /**
     * 金币添加
     */
    public static function setGold($uid,$genre,$gold)
    {
        if (!$uid) { echo "<script>alert('没有登录！');history.go(-1);</script>";exit; }
        $data = [
            'uid'=> $uid,
            'genre'=> $genre,
            'gold'=> $gold,
            'created_at'=> time(),
        ];
        UserGoldModel::create($data);
    }
}