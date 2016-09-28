<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;
use App\Models\Base\PicModel;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','serial','genre','cate','gif','intro','uid','pid','isauth','istop','sort','isshow','created_at','updated_at',
    ];
    protected $genres = [
        1=>'个人供应','企业供应','平台供应',
    ];
    protected $isauths = [
        1=>'未审核','未通过审核','通过审核',
    ];
    protected $istops = [
        '不置顶','置顶',
    ];
    protected $isshows = [
        1=>'不显示','显示',
    ];

    public function genre()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }
    public function isauth()
    {
        return array_key_exists($this->isauth,$this->isauths) ? $this->isauths[$this->isauth] : '';
    }
    public function istop()
    {
        return array_key_exists($this->istop,$this->istops) ? $this->istops[$this->istop] : '';
    }
    public function isshow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->getPic($this->gif);
    }

    /**
     * 获取该产品的属性
     */
    public function getAttrs()
    {
        return ProductAttrModel::where('productid',$this->id)->get();
    }
}