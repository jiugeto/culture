<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkModel extends Model
{
    protected $table = 'bs_links';
    public $timestamps = false;
    protected $fillable = [
        'id','name','title','type','pic','intro','link','display_way','isshow','pid','created_at','updated_at',
    ];
//    protected $types = [
//        1=>'header头链接','navigate菜单导航栏链接','footer脚部链接',
//    ];

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
}