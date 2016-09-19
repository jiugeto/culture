<?php
namespace App\Models;

use App\Models\Base\PicModel;

class StoryBoardModel extends BaseModel
{
    /**
     * 分镜模型
     */
    protected $table = 'bs_storyboards';
    protected $fillable = [
        'id','name','genre','cate','thumb','detail','intro','uid','uname','money','isnew','ishot','sort','isshow','sort2','isshow2','del','created_at','updated_at',
    ];
    protected $genres = [
        1=>'企业供应','企业需求','个人供应','个人需求',
    ];
//    protected $cates = [
//        1=>'宣传片','广告片','微电影','专题片','汇报片','主题片','晚会视频','婚纱摄影','淘宝视频',
//    ];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getCateName()
    {
        return array_key_exists($this->cate,$this->cates2) ? $this->cates2[$this->cate] : '';
    }

    public function user()
    {
        $uid = $this->uid ? $this->uid : '0';
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel->username : '无';
    }

    public function company()
    {
        $uid = $this->uid ? $this->uid : '0';
        $companyModel = CompanyModel::where('uid',$uid)->first();
        return $companyModel ? $companyModel : '';
    }

    public function getComName()
    {
        return $this->company() ? $this->limits($this->company()->name,5) : '';
    }

    public function limits($name,$length)
    {
        return mb_strlen($name)>$length ? mb_substr($name,0,$length,'utf-8') : $name;
    }

    public function thumb()
    {
        $picModel = PicModel::find($this->thumb);
        return $picModel ? $picModel->url : '';
    }

    public function getLike()
    {
        $likeModels = StoryBoardLikeModel::where('sbid',$this->id)->get();
        return $likeModels ? count($likeModels) : 0;
    }

//    /**
//     * 细节查看权限
//     */
//    public function getShow()
//    {
//        if ($this->genre==1) {
//            //供应分镜
//            $orderModel = OrderModel::where('buyer',$this->uid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        } elseif ($this->genre==2) {
//            //需求分镜
//            $orderModel = OrderModel::where('seller',$this->uid)
//                ->where('status','>',11)
//                ->where('isshow',1)
//                ->where('del',0)
//                ->first();
//        }
//        return (isset($orderModel)&&$orderModel) ? 1 : 0;
//    }

    /**
     * 是否为最新记录
     */
    public function isnew()
    {
        return $this->isnew ? '最新' : '非最新';
    }

    /**
     * 是否为最热记录
     */
    public function ishot()
    {
        return $this->ishot ? '最热' : '非最热';
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