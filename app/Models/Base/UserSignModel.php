<?php
namespace App\Models\Base;

class UserSignModel extends \App\Models\BaseModel
{
    /**
     * 这是用户签到表
     */

    protected $table = 'bs_user_sign';
    protected $fillable = [
        'id','uid','reward','created_at','updated_at',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->uid ? $this->getUserName($this->uid) : '';
    }

    public function reward()
    {
        return $this->reward ? $this->reward.'个奖励' : '';
    }

    /**
     * 当前用户签到状态
     */
    public function getSignStatus($uid,$dateStr)
    {
        $dateArr = explode('-',$dateStr);
        $day = strlen($dateArr[2])==1?'0'.$dateArr[2]:$dateArr['2'];
        $date = $dateArr[0].$dateArr[1].$day;
        $dayCurr = date('Ymd',time());

        $fromtime = $date.'000000';      //凌晨0点
        $totime = $date.'240000';      //夜里24点
        $userSignModel = UserSignModel::where('uid',$uid)
            ->where('created_at','>',strtotime($fromtime))
            ->where('created_at','<',strtotime($totime))
            ->first();

        if ($date<$dayCurr) {
            //过去的签到状态
            if ($userSignModel) {
                $status['code'] = 1;
                $status['name'] = '已签到';
            } else {
                $status['code'] = 2;
                $status['name'] = '未签到';
            }
        } elseif ($date>=$dayCurr) {
            //当天、未来签到状态
            if ($userSignModel) {
                $status['code'] = 3;
                $status['name'] = '已签到';
            } else {
                $status['code'] = 4;
                $status['name'] = '待签到';
            }
        } else {
            $status['code'] = 0;
            $status['name'] = '签到';
        }
        return $status;
    }
}