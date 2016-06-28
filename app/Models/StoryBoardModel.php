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

    public function getShow()
    {
        $shows = StoryBoardsShowModel::where('sbid',$this->id)->where('isauth',2)->get();
        if (count($shows)) {
            foreach ($shows as $show) {
                $showIds[] = $show->uid;
            }
        }
        return isset($showIds) ? $showIds : [];
    }
}