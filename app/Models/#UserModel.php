<?php
namespace App\Models;

use App\Models\Base\PicModel;

class UserModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'users';
    protected $fillable = [
        'id','username','password','pwd','email','qq','tel','mobile','area','address','head','isauth','emailck','isuser','isvip','limit','created_at','updated_at','lastLogin',
    ];
    protected $isauths = [      //用户认证：0未认证，1认证，2认证失败，3认证成功
        1=>'未认证','认证失败','认证成功',
    ];
    protected $isusers = [
        1=>'普通用户','个人会员','普通企业','设计师','广告公司','影视公司','租赁公司',
        50=>'超级用户',
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

    /**
     * 会员个人信息
     */
    public function person()
    {
        return PersonModel::where('uid',$this->id)->first();
    }

    public function company($uid)
    {
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    public function lastLogin()
    {
        return $this->lastLogin ? date('Y年m月d日 H:i',$this->lastLogin) : $this->createTime();
    }

    public function head()
    {
        $picModel = PicModel::find($this->head);
        return $picModel ? $picModel->url : '';
    }

    public function sex()
    {
        return $this->person()->sex==1 ? '男' : '女';
    }

    public function realname()
    {
        return $this->person()->realname;
    }

    /**
     * 身份证号码
     */
    public function idcard()
    {
        return $this->person()->idcard;
    }
}