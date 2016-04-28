<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use App\Tools;

class GoodsModel extends BaseModel
{
    /**
     * goods 商品、货物，代表文化类产品
     */

    protected $table = 'bs_goods';
    protected $fillable = [
        'id','name','genre','type','cate_id','intro','title','pic_id','video_id','uid','uname','recommend','sort','isshow','isshow2','del','created_at','updated_at',
    ];

    protected $types = [
        //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
        1=>'个人需求','设计师供应','企业需求','企业供应',
    ];

    public function cate()
    {
//        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
        return $this->cate_id?CategoryModel::find($this->cate_id):'';
    }

    /**
     * 得到所有分类
     */
    public function categorys()
    {
        $categorys =  CategoryModel::where('del',0)->get();
//        $categorys = Tools::category($categorys);
        $categorys = Tools::getChild($categorys);
        return $categorys;
    }

    /**
     * 发布单位类型
     */
    public function type()
    {
        return $this->type ? $this->types[$this->type] : '';
    }

    /**
     * 图片
     */
    public function pics()
    {
        return PicModel::where('uid',$this->uid)->get();
    }

    /**
     * 视频
     */
    public function videos()
    {
        return VideoModel::where('uid',$this->uid)->get();
    }

    /**
     * 图片
     */
    public function pic()
    {
//        return $this->hasOne('\App\Models\PicModel','id','pic_id');
        return $this->pic_id ? PicModel::find($this->pic_id) : '';
    }

    /**
     * 视频
     */
    public function video()
    {
        return $this->video_id ? VideoModel::find($this->video_id) : '';
//        return $this->hasOne('\App\Models\VideoModel','id','video_id');
    }
}