<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class LinkModel extends BaseModel
{
    protected $table = 'bs_links';
    protected $fillable = [
        'id','name','cid','title','type_id','pic','intro','link','display_way','isshow','pid','sort','created_at','updated_at',
    ];

    protected $types = [
        1=>'header头链接','navigate菜单导航栏链接','footer脚部链接',
    ];
    protected $isshows = [
       '不显示','显示',
    ];

//    /**
//     * 关联类型表
//     */
//    public function type()
//    {
//        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
//    }
    public function type()
    {
        return $this->type_id ? $this->types[$this->type_id] : '';
    }

    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 关联图片表
     */
    public function pic()
    {
        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
    }
//    public function pic()
//    {
//        return $this->pic_id ? PicModel::find($this->pic_id) : '';
//    }

    /**
     * 顶部链接：type_id==1
     */
    public static function headers()
    {
        return LinkModel::where('cid', 0)
                ->where('type_id', 1)
                ->orderBy('sort','desc')
                ->get();
    }

    /**
     * 头部链接：type_id==2
     */
    public static function navigates()
    {
        return LinkModel::where('cid', 0)
                ->where('type_id', 2)
                ->orderBy('sort','desc')
                ->paginate(11);
    }

    /**
     * 底部链接：type_id==3
     */
    public static function footers()
    {
        return LinkModel::where('cid', 0)
                ->where('type_id', 3)
                ->orderBy('sort','desc')
                ->paginate(10);
    }

    public function company()
    {
        return $this->cid ? CompanyModel::find($this->id) : '本网站';
    }

//    /**
//     * 企业页面header菜单 type_id==2
//     */
//    public function comHeaders()
//    {
//        return LinkModel::where('cid',$this->cid)
//                ->where('type_id', 2)
//                ->where('isshow', 1)
//                ->orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->get();
//    }
}