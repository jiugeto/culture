<?php
namespace App\Models;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;
use App\Models\Base\PicModel;

class IdeasModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'bs_ideas';
    protected $fillable = [
        'id','name','cate','thumb','intro','content','uid','sort','isshow','del','created_at','updated_at',
    ];

    public function getCate()
    {
       return array_key_exists($this->cate,$this->cates) ? $this->cates[$this->cate] : '';
    }

    public function read($uid)
    {
        $datas = IdeasReadModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
    }

    public function click($uid)
    {
        $datas = IdeasClickModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
    }

    public function collect($uid)
    {
        $datas = IdeasCollectModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
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