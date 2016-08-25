<?php
namespace App\Models\Base;

class UserFrieldModel extends \App\Models\BaseModel
{
    /**
     * 这是用户好友表
     */

    protected $table = 'bs_user_frield';
    protected $fillable = [
        'id','uid','frield_id','isauth','remarks','remarks2','del','created_at','updated_at',
    ];

    protected $isauths = [
        1=>'好友申请','好友拒绝','好友同意',
    ];

    public function getAuthName()
    {
        return array_key_exists($this->isauth,$this->isauths) ? $this->isauths[$this->isauth] : '';
    }

//    public function getUName()
//    {
//        return $this->getCompanyName($this->frield_id) ?
//            $this->getCompanyName($this->frield_id) : $this->getUserName($this->frield_id);
//    }

    public function getFrieldName()
    {
        return $this->getUser($this->frield_id) ? $this->getUser($this->frield_id)->username : '';
    }

    /**
     * 用户头像
     */
    public function getHeadUrl()
    {
        $companylogo = $this->getCompanyMain($this->frield_id) ? $this->getCompanyMain($this->frield_id)->logo : '';
        $userhead = '';
        if (!$companylogo && $userInfo=$this->getUser($this->frield_id)) {
            $userheadid = $userInfo->head ? $userInfo->head : 0;
            $picModel = PicModel::find($userheadid);
            $userhead = $picModel ? $picModel->url : '';
        }
        return $companylogo ? $companylogo : $userhead;
    }
}