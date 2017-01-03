<?php
namespace App\Models;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;

class EntertainModel extends BaseModel
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'id','title','genre','content','uid','sort','del','created_at','updated_at',
    ];
    protected $genres = [
        1=>'企业供应','企业需求',
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
        $rstUser = ApiUsers::getOneUser($uid);
        return $rstUser['code']==0 ? $rstUser['data'] : [];
    }

    /**
     * 发布人公司信息
     */
    public function company()
    {
        $uid = $this->uid ? $this->uid : 0;
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
}