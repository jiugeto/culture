<?php
namespace App\Models;

class ProductLayerModel extends BaseModel
{
    protected $table = 'bs_products_layer';
    protected $fillable = [
        'id','productid','attrid','layerid','attrSel','per','val','created_at','updated_at',
    ];

    //width,height,,color,font_size,word_spacing,line_height,background,left,top,overflow,opacity
    protected $attrs = [
        1=>'width','height','color','font_size','word_spacing','line_height','background','left','top','opacity',
    ];
    protected $attrNames = [
        1=>'宽度','高度','颜色','字体大小','字间距','行高','背景色','左边距离','右边距离','透明度',
    ];

    public function productAll()
    {
        return ProductModel::all();
    }

    public function products($uid=0)
    {
        return ProductModel::where('uid',$uid)->get();
    }

    public function product()
    {
        if ($this->productid) {
            $productModel = ProductModel::find($this->productid);
            if ($productModel) { $pname = $productModel->name; }
        }
        return isset($pname) ? $pname : '未知';
    }

    public function attrAll()
    {
        return ProductAttrModel::all();
    }

    public function attrs($uid=0)
    {
        return ProductAttrModel::where('uid',$uid)->get();
    }

    public function attrname()
    {
        if ($this->attrid) {
            $attrModel = ProductAttrModel::find($this->attrid);
            if ($attrModel) { $attrname = $attrModel->style_name; }
        }
        return isset($attrname) ? $attrname : '未知';
    }

    public function layerAll()
    {
        return ProductLayerModel::all();
    }

    public function layers()
    {
        return ProductLayerModel::find($this->layerid);
    }

    public function layer()
    {
        if ($this->attrid) {
            $layerModel = ProductLayerModel::find($this->layerid);
            if ($layerModel) {
                $layername = array_key_exists($layerModel->attrSel,$this->attrNames)?$this->attrNames[$layerModel->attrSel]:'';
            }
        }
        return isset($layername) ? $layername : '未知';
    }
}