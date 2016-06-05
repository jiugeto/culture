<?php
namespace App\Models;

class ProductLayerAttrModel extends BaseModel
{
    protected $table = 'bs_pro_layer_attr';
    protected $fillable = [
        'id','productid','attrid','layerid','attrSel','per','val','del','created_at','updated_at',
    ];

    //属性：width,height,,color,font_size,word_spacing,line_height,background,left,top,overflow,opacity
    protected $attrSels = [
        1=>'width',2=>'height',3=>'color',4=>'font_size',5=>'word_spacing',6=>'line_height',7=>'background',8=>'left',9=>'top',10=>'opacity',
    ];
    protected $attrSelNames = [
        1=>'宽度',2=>'高度',3=>'颜色',4=>'字体大小',5=>'字间距',6=>'行高',7=>'背景色',8=>'左边距离',9=>'右边距离',10=>'透明度',
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

    public function layerAll()
    {
        return ProductLayerModel::all();
    }

    public function layers()
    {
        return ProductLayerModel::find($this->layerid);
    }

    //动画名称 ProductLayerModel
    public function layer()
    {
        $layerid = $this->layerid ? $this->layerid : 0;
        $layerModel = ProductLayerModel::find($layerid);
        if ($layerModel) {
//            $layername = array_key_exists($layerModel->attrSel,$this->attrSelNames)?$this->attrSelNames[$layerModel->attrSel]:'无';
            $layername = $layerModel->name;
        }
        return isset($layername) ? $layername : '未知';
    }

    public function getLayer()
    {
        $layerid = $this->layerid ? $this->layerid : 0;
        $layerModel = ProductLayerModel::find($layerid);
        return isset($layerModel) ? $layerModel : '未知';
    }

    //动画属性 ProductLayerAttrModel
    public function layerAttr()
    {
        return array_key_exists($this->attrSel,$this->attrSels)?$this->attrSels[$this->attrSel]:'无';
    }

    public function layerAttrName()
    {
        return array_key_exists($this->attrSel,$this->attrSelNames)?$this->attrSelNames[$this->attrSel]:'无';
    }

    public function getLayerAttr($attrSel)
    {
        return array_key_exists($attrSel,$this->attrSels)?$this->attrSels[$attrSel]:'无';
    }

    public function getLayerAttrName($attrSel)
    {
        return array_key_exists($attrSel,$this->attrSelNames)?$this->attrSelNames[$attrSel]:'无';
    }
}