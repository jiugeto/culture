<?php
namespace App\Models;

class EntertainModel extends BaseModel
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'id','title','genre','content','uid','sort','del','created_at','updated_at',
    ];

    /**
     * 娱乐公司的所有职员
     */
    public function getStaffs()
    {
        $entertainid = $this->id ? $this->id : 0;
        return StaffModel::where('entertain_id',$entertainid)->get();
    }

    /**
     * 娱乐公司的所有图片
     */
    public function getPics()
    {
        $entertainid = $this->id ? $this->id : 0;
        return EntertainPicModel::where('entertain_id',$entertainid)->get();
    }

    /**
     * 发布人信息
     */
    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    /**
     * 发布人名称
     */
    public function getUserName()
    {
        return $this->user() ? $this->user()->username : '';
    }

    /**
     * 发布人公司信息
     */
    public function company()
    {
        $uid = $this->uid ? $this->uid : 0;
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    /**
     * 发布人公司名称
     */
    public function getCompanyName()
    {
        return $this->company() ? $this->company()->name : '';
    }
}