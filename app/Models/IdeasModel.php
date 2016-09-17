<?php
namespace App\Models;

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

//    /**
//     * 细节查看权限
//     */
//    public function iscon()
//    {
//        if ($this->genre==1) {
//            //供应分镜
//            $orderModel = OrderModel::where('buyer',$uid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        } elseif ($this->genre==2) {
//            //需求分镜
//            $orderModel = OrderModel::where('seller',$this->userid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        }
//        $iscon = 0;
//        if (isset($orderModel)&&$orderModel) {
//            if ($orderModel->status<12) { $iscon = 1; }
//            elseif ($orderModel->status==13) { $iscon = 2; }
//            elseif ($orderModel->status==12) { $iscon = 3; }
//            $remarks = $orderModel->remarks;
//        }
//        return array('iscon'=> $iscon, 'remarks'=> isset($remarks)?$remarks:'');
//    }

    /**
     * 获取图片
     */
    public function pic()
    {
        $pic_id = $this->pic_id ? $this->pic_id : 0;
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