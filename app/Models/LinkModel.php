<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class LinkModel extends BaseModel
{
    protected $table = 'bs_links';
    protected $fillable = [
        'id','name','title','type_id','pic','intro','link','display_way','isshow','pid','sort','created_at','updated_at',
    ];

    protected $types = [
        1=>'header头链接','navigate菜单导航栏链接','footer脚部链接',
    ];

    /**
     * 关联类型表
     */
    public function type()
    {
        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
    }

    /**
     * 关联图片表
     */
    public function pic()
    {
        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
    }

//    /**
//     * 顶部链接，头部菜单链接，左部菜单链接，底部链接
//     */
//    public function links()
//    {
//        return [
//            'headers'=> $this->headers(),
//            'navigates'=> $this->navigates(),
//            'footers'=> $this->footers(),
//            'menus'=> $this->menus(),
//        ];
//    }

    /**
     * 顶部链接：type_id==1
     */
    public static function headers()
    {
        return LinkModel::where('type_id', 1)->orderBy('sort','desc')->get();
    }

    /**
     * 头部链接：type_id==2
     */
    public static function navigates()
    {
        return LinkModel::where('type_id', 2)->orderBy('sort','desc')->paginate(10);
    }

    /**
     * 底部链接：type_id==3
     */
    public static function footers()
    {
        return LinkModel::where('type_id', 3)->orderBy('sort','desc')->paginate(10);
    }

//    /**
//     * 底部链接：type_id==4
//     */
//    public static function menus()
//    {
//        return LinkModel::where('type_id', 4)->get();
//    }
}