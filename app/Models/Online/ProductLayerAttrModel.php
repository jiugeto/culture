<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductLayerAttrModel extends BaseModel
{
    protected $table = 'bs_pro_layer_attr';
    protected $fillable = [
        'id','attrid','layerid','attrSel','per','val','created_at','updated_at',
    ];

    protected $attrSels = [
        1=>'width','height','left','top','opacity',
    ];
    protected $attrSelNames = [
        1=>'宽度','高度','左边距离','右边距离','透明度',
    ];

    public function getAttrName()
    {
        if ($this->attrid) {
            $attrModel = ProductAttrModel::find($this->attrid);
            if ($attrModel) { $attrname = $attrModel->style_name; }
        }
        return isset($attrname) ? $attrname : '';
    }

    public function getlayer()
    {
        $layerid = $this->layerid ? $this->layerid : 0;
        $layerModel = ProductLayerModel::find($layerid);
        if ($layerModel) {
            $layername = $layerModel->name;
        }
        return isset($layername) ? $layername : '';
    }
}