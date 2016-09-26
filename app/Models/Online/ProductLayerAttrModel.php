<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductLayerAttrModel extends BaseModel
{
    protected $table = 'bs_pro_layer_attr';
    protected $fillable = [
        'id','productid','layerid','attrSel','per','val','created_at','updated_at',
    ];

    protected $attrSels = [
        1=>'width','height','left','top','opacity',
    ];
    protected $attrSelNames = [
        1=>'宽度','高度','左边距离','顶边距离','透明度',
    ];

    /**
     * 产品信息
     */
    public function getProduct()
    {
        $productModel = ProductModel::find($this->productid);
        return $productModel ? $productModel : '';
    }

    /**
     * 产品名称
     */
    public function getProductName()
    {
        return $this->getProduct() ? $this->getProduct()->name : '';
    }

    /**
     * 动画设置信息
     */
    public function getlayer()
    {
        $layerid = $this->layerid ? $this->layerid : 0;
        $layerModel = ProductLayerModel::find($layerid);
        return $layerModel ? $layerModel : '';
    }

    /**
     * 动画设置名称
     */
    public function getlayerName()
    {
        return $this->getlayer() ? $this->getlayer()->name : '';
    }

    /**
     * 动画的属性名称
     */
    public function getAttrSelName()
    {
        return array_key_exists($this->attrSel,$this->attrSelNames) ? $this->attrSelNames[$this->attrSel] : '';
    }

    /**
     * 动画值
     */
    public function getVal()
    {
        if (in_array($this->attrSel,[1,2,3,4])) {
            $val = $this->val.'px';
        } elseif ($this->attrSel==5) {
            $val = $this->val.'%';
        }
        return $val;
    }
}