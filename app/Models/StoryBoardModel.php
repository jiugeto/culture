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
        'id','name','genre','cate_id','thumb','imgs','intro','uid','money','isnew','ishot','sort','isshow','sort2','isshow2','del','created_at','updated_at',
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

    public function imgs()
    {
        $imgs = $this->imgs ? explode(',',$this->imgs) : [];
        $picModels = $imgs ? PicModel::whereIn('id',$imgs)->get() : [];
        return $picModels ? $picModels : [];
    }

    public function getLike()
    {
        $likeModels = StoryBoardLikeModel::where('sbid',$this->id)->get();
        return $likeModels ? count($likeModels) : 0;
    }
}