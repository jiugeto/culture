<?php
namespace App\Models;

class RentModel extends BaseModel
{
    protected $table = 'bs_rents';
    protected $fillable = [
        'id','name','genre','intro','uid','area','price','sort','del','created_at','updated_at',
    ];

    /**
     * 用户信息
     */
    public function user()
    {
        $uid = $this->uid?$this->uid:0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    /**
     * 公司信息
     */
    public function company()
    {
        $uid = $this->uid?$this->uid:0;
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    /**
     * 获得公司名称或用户名称
     */
    public function getUName()
    {
        $name = $this->company() ? $this->company()->name : '';
        if (!$name) {
            $name = $this->user() ? $this->user()->username : '';
        }
        return $name;
    }

    /**
     * id 找 pics
     */
    public function pics($arrs)
    {
        $pics = [];
        if (is_array($arrs)) {
            foreach ($arrs as $arr) {
                $pic_id = RentPicModel::find($arr->id)->pic_id;
                $pics[] = PicModel::find($pic_id);
            }
        }
        return $pics;
    }

    /**
     * 人员公司的所有图片
     */
    public function getPics()
    {
        $staff_id = $this->id ? $this->id : 0;
        return StaffPicModel::where('staff_id',$staff_id)->get();
    }

    public function money()
    {
        return $this->price ? $this->price.'元' : '暂无';
    }

    /**
     * 有效期
     */
    public function period()
    {
        $statusName = '';
        if ($this->fromtime>time() && $this->totime<time()) {
            $statusName = '有效期内';
        } elseif ($this->fromtime < time()) {
            $statusName = '已过期';
        } elseif ($this->totime > time()) {
            $statusName = '未开始';
        }
        return $statusName;
    }
}