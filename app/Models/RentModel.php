<?php
namespace App\Models;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;
use App\Models\Base\PicModel;

class RentModel extends BaseModel
{
    protected $table = 'bs_rents';
    protected $fillable = [
        'id','name','genre','type','thumb','intro','uid','area','money','sort','del','created_at','updated_at',
    ];
    //设备类型：摄像机，摇臂，转接器，镜头，轨道车，脚轮，脚架，话筒，调音台，监视器，灯光，反光板，柔光板，采集卡，硬盘，
    protected $types = [
        1=>'摄像机','摇臂','转接器','镜头','轨道车','脚轮','脚架','话筒','调音台','监视器','灯光','反光板','柔光板','采集卡','硬盘',
    ];

    public function getType()
    {
       return array_key_exists($this->type,$this->types) ? $this->types[$this->type] : '';
    }

    /**
     * 用户信息
     */
    public function user()
    {
        $uid = $this->uid?$this->uid:0;
//        $userModel = UserModel::find($uid);
//        return $userModel ? $userModel : '';
        $rstUser = ApiUsers::getOneUser($uid);
        return $rstUser['code']==0 ? $rstUser['data'] : [];
    }

    /**
     * 公司信息
     */
    public function company()
    {
        $uid = $this->uid?$this->uid:0;
//        $companyModel = CompanyModel::where('uid',$uid)->first();
//        return $companyModel ? $companyModel : '';
        $rstCompany = ApiCompany::getOneCompany($uid);
        return $rstCompany['code']==0 ? $rstCompany['data'] : [];
    }

    /**
     * 获得公司名称或用户名称
     */
    public function getUName()
    {
        $name = $this->company() ? $this->company()['name'] : '';
        if (!$name) {
            $name = $this->user() ? $this->user()['username'] : '';
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
        return $this->price ? $this->money.'元' : '暂无';
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

    /**
     * 获取图片
     */
    public function pic()
    {
        $pic_id = $this->thumb ? $this->thumb : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    /**
     * 获取图片url
     */
    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->getUrl() : '';
    }
}