<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class StoryBoardModel extends BaseModel
{
    /**
     * 分镜模型
     */
    protected $table = 'bs_storyboards';
    protected $fillable = [
        'id','name','genre','cate_id','thumb','detail','intro','uid','money','isnew','ishot','sort','isshow','sort2','isshow2','del','created_at','updated_at',
    ];

    public function cates()
    {
        return CategoryModel::where('pid',1)->get();
    }

    public function cate()
    {
        $cate_id = $this->cate_id ? $this->cate_id : 0;
        $cateModel = CategoryModel::find($cate_id);
        return $cateModel ? $cateModel->name : '无';
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
}