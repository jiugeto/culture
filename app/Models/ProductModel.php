<?php
namespace App\Models;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','gif','intro','uid','uname','width','height','isattr','isauth','istop','sort','isshow','del','created_at','updated_at',
    ];
    protected $genres = [
        1=>'个人供应','企业供应',
    ];
    protected $isauths = [
        1=>'未审核','未通过审核','通过审核',
    ];
    protected $istops = [
        1=>'不置顶','置顶',
    ];
    protected $isshows = [
        1=>'不显示','显示',
    ];

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '';
    }
    public function isauth()
    {
        return $this->isauth ? $this->isauths[$this->isauth] : '';
    }
    public function istop()
    {
        return $this->istop ? $this->istops[$this->istop] : '';
    }
    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
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