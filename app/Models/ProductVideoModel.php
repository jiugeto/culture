<?php
namespace App\Models;

class ProductVideoModel extends BaseModel
{
    /**
     * 动画/效果定制
     */

    protected $table = 'bs_pro_videos';
    protected $fillable = [
        'id','name','genre','cate','uid','intro','thumb','linkType','link','isshow','created_at','updated_at',
    ];
    protected $genres = [
        1=>'动画定制','效果定制',
    ];
    protected $linkTypes = [
        1=>'flash代码','html代码','通用代码','其他视频网址',
    ];
    protected $isshows = [
        '所有','不显示','显示',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    public function getCate()
    {
        return array_key_exists($this->cate,$this->cates2) ? $this->cates2[$this->cate] : '';
    }

    public function getLinkTypeName()
    {
        return array_key_exists($this->linkType,$this->linkTypes) ? $this->linkTypes[$this->linkType] : '';
    }
}