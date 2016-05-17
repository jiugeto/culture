<?php
namespace App\Models;

class ProductLayerAttrModel extends BaseModel
{
    protected $table = 'bs_pro_layer_attr';
    protected $fillable = [
        'id','productid','attrid','layerid','attrSel','per','val','created_at','del','updated_at',
    ];

    //width,height,,color,font_size,word_spacing,line_height,background,left,top,overflow,opacity
    protected $attrSels = [
        1=>'width','height','color','font_size','word_spacing','line_height','background','left','top','opacity',
    ];
    protected $attrSelNames = [
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
        return isset($pname) ? $pname : '无';
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
        return isset($attrname) ? $attrname : '无';
    }

//    public function layerAll()
//    {
//        return ProductLayerModel::all();
//    }
//
//    public function layers()
//    {
//        return ProductLayerModel::find($this->layerid);
//    }

    public function layer()
    {
        $layerid = $this->layerid ? $this->layerid : 0;
        $layerModel = ProductLayerModel::find($layerid);
        if ($layerModel) {
            $layername = array_key_exists($layerModel->attrSel,$this->attrSelNames)?$this->attrSelNames[$layerModel->attrSel]:'无';
        }
        return isset($layername) ? $layername : '未知';
    }

    public function layerAttr()
    {
        return array_key_exists($this->attrSel,$this->attrSelNames)?$this->attrSelNames[$this->attrSel]:'无';
    }
}