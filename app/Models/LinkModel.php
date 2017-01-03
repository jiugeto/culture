<?php
namespace App\Models;

use App\Api\ApiUser\ApiCompany;

class LinkModel extends BaseModel
{
    protected $table = 'bs_links';
    protected $fillable = [
        'id','name','cid','title','type_id','pic_id','intro','link','display_way','isshow','pid','sort','created_at','updated_at',
    ];

    protected $types = [
        1=>'header头链接','navigate菜单导航栏链接','footer脚部链接',
    ];
    protected $isshows = [
       '不显示','显示',
    ];

    public function type()
    {
        return $this->type_id ? $this->types[$this->type_id] : '';
    }

    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
    }

//    /**
//     * 关联图片表
//     */
//    public function pic()
//    {
//        return $this->hasOne('App\Models\PicModel', 'id', 'pic_id');
//    }

    /**
     * 顶部链接：type_id==1
     */
    public static function headers()
    {
        return LinkModel::where('cid', 0)
                ->where('type_id', 1)
                ->where('isshow', 1)
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
                ->where('isshow', 1)
                ->orderBy('sort','desc')
                ->paginate(10);
    }

    /**
     * 底部链接：type_id==3
     */
    public static function footers()
    {
        return LinkModel::where('cid', 0)
                ->where('type_id', 3)
                ->where('isshow', 1)
                ->orderBy('sort','desc')
                ->paginate(10);
    }

    public function company()
    {
        $companyArr = ApiCompany::getOneCompany($this->cid);
        return $companyArr['code']==0 ? $companyArr['data'] : '本网站';
    }
}