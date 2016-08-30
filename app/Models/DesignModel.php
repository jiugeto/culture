<?php
namespace App\Models;

class DesignModel extends BaseModel
{
    protected $table = 'bs_designs';
    protected $fillable = [
        'id','name','genre','cate','uid','intro','detail','price','video_id','click','sort','del','created_at','updated_at',
    ];
    //1企业供应，2企业需求，3个人供应，4个人需求
    protected $genres = [
        1=>'个人供应','个人需求','企业供应','企业需求',
    ];
//    //类型：房产，效果图，平面，漫游
//    protected $cates = [
//        1=>'房产漫游','效果图','平面设计',
//    ];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getCateName()
    {
        return array_key_exists($this->cate,$this->cates) ? $this->cates[$this->cate] : '';
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

    public function UserName()
    {
        return $this->user() ? $this->user()->username : '';
    }

    public function money()
    {
        return $this->price ? $this->price.'元' : '';
    }

    /**
     * 设计的所有图片
     */
    public function getPics()
    {
        $design_id = $this->id ? $this->id : 0;
        return DesignPicModel::where('design_id',$design_id)->get();
    }

    /**
     * 设计的一张图片
     */
    public function getOnePic()
    {
        $pic_id = count($this->getPics()) ? $this->getPics()[0]->pic_id : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    /**
     * 设计的一张图片url
     */
    public function getOnePicUrl()
    {
        return $this->getOnePic() ? $this->getOnePic()->url : '';
    }
}