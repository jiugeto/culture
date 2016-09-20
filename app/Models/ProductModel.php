<?php
namespace App\Models;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','gif','intro','uid','uname','isattr','isauth','istop','sort','isshow','del','created_at','updated_at',
    ];
    protected $genres = [
        1=>'个人供应','企业供应',
    ];
    protected $isauths = [
        '未审核','未通过审核','通过审核',
    ];
    protected $istops = [
        '不置顶','置顶',
    ];
    protected $isshows = [
        '不显示','显示',
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

    public function attrs()
    {
        return ProductAttrModel::where('productid',$this->id)->get();
    }

    public function layers()
    {
        return ProductLayerModel::where('productid',$this->id)->get();
    }

    public function cons()
    {
        return ProductConModel::where('productid',$this->id)->get();
    }

    /**
     * 得到图片信息
     */
    public function getPic()
    {
        $pic_id = $this->gif ? $this->gif : 0;
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel : '';
    }

    /**
     * 获取图片链接
     */
    public function getPicUrl()
    {
        return $this->getPic() ? $this->getPic()->url : '';
    }
}