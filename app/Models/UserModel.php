<?php
namespace App\Models;

class UserModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','email','qq','tel','mobile','isauth','emailck','isuser','isvip','limit','created_at','updated_at','lastLogin',
    ];
    protected $isauths = [      //用户认证：0未认证，1认证，2认证失败，3认证成功
        '未认证','认证中','认证失败','认证成功',
    ];
    protected $isusers = [
        0=>'非会员',1=>'个人消费者','普通企业','设计师','广告公司','影视公司','租赁公司',
    ];
    protected $isvips = [
        '非VIP','VIP会员',
    ];

    public function isauth()
    {
        return $this->isauths[$this->isauth];
    }

    public function isuser()
    {
        return $this->isuser ? $this->isusers[$this->isuser] : '';
    }

    public function isvip()
    {
        return $this->isvips[$this->isvip];
    }

    public function person()
    {
        return $this->hasOne('\App\Models\PersonModel','id','uid');
    }

    public function company($uid)
    {
//        return $this->hasOne('\App\Models\CompanyModel','id','uid');
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    public function lastLogin()
    {
        return $this->lastLogin ? date('Y年m月d日 H:i',$this->lastLogin) : $this->createTime();
    }
}