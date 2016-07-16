<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Admin\ComMainController;
use App\Models\Company\ComMainModel;
use App\Tools;

class GoodsModel extends BaseModel
{
    /**
     * goods 商品、货物，代表文化类产品
     */

    protected $table = 'bs_goods';
    protected $fillable = [
        'id','name','genre','type','cate_id','intro','title','pic_id','video_id','video_id2','uid','uname','click','recommend','newest','sort','isshow','isshow2','del','created_at','updated_at',
    ];

    //片源类型：1产品，2花絮
    protected $genres = [
        1=>'产品','花絮',
    ];
    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $types = [
        1=>'个人需求','设计师供应','企业需求','企业供应',
    ];
    protected $recommends = [
        '不推荐','推荐',
    ];
    protected $isshows = [
        '不显示','显示',
    ];

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

    public function cate()
    {
//        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
//        return $this->cate_id?CategoryModel::find($this->cate_id):'';
        $cateModel = $this->cate_id?CategoryModel::find($this->cate_id):'';
        return $cateModel ? $cateModel->name : '';
    }

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '';
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
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->pic() ? $this->pic()->url : '';
    }

    /**
     * 获取图片尺寸：高度100，确定宽度
     */
    public function getPicSize($w,$h)
    {
        $pic = $this->pic();
        if ($pic && $pic->width && $pic->height) {
            $ratio_h = $h / $pic->height;
            //确定高度 $h，计算$w
            $width=$ratio_h*$pic->width;
            if ($width>$w) { $size = $width; } else  { $size = $w; }
        }
        return (isset($size)&&$size) ? $size : 0;
    }

    /**
     * 视频
     */
    public function video()
    {
        return $this->video_id ? VideoModel::find($this->video_id) : '';
//        return $this->hasOne('\App\Models\VideoModel','id','video_id');
    }

    /**
     * 获取视频链接
     */
    public function getVideoUrl()
    {
        return $this->video() ? $this->video()->url : '';
    }

    public function title()
    {
        return $this->title ? $this->title : $this->name;
    }

    public function recommend()
    {
        return array_key_exists($this->recommend,$this->recommends) ? $this->recommends[$this->recommend] : '';
    }

    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 视频发布方信息
     */
    public function getUserInfo()
    {
        $companyMian = ComMainModel::where('uid',$this->uid)->first();
        return $companyMian ? $companyMian : '';
    }

    public function getComLogo()
    {
        return $this->getUserInfo() ? $this->getUserInfo()->logo : '';
    }

    /**
     * 用户类型数组 arr
     * 推荐和最新：recommend、newest
     */
    public function getNewests($arr)
    {
        if ($arr) {
            $userModels = UserModel::whereIn('isuser',$arr)->get();
            $userIds = array();
            if ($userModels) {
                foreach ($userModels as $userModel) {
                    $userIds[] = $userModel->id;
                }
            }
            return GoodsModel::whereIn('uid',$userIds)
                ->where('newest',1)
                ->where('isshow',1)
                ->where('isshow2',1)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
//            ->get();
        } else {
            return GoodsModel::where('newest',1)
                ->where('isshow',1)
                ->where('isshow2',1)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
    }

    /**
     * 用户类型
     */
    public function userType()
    {
        $userModel = UserModel::find($this->uid);
        return $userModel ? $userModel->isuser : '';
    }
}