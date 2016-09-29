<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductLayerModel extends BaseModel
{
    protected $table = 'bs_pro_layer';
    protected $fillable = [
        'id','name','productid','a_name','timelong','func','delay','record','is_add','created_at','updated_at',
    ];
    //速度曲线
    protected $funcs = [
        1=>'linear','ease','ease-in','ease-out','ease-in-out',/*'cubic-bezier',*/
    ];
    protected $funcNames = [
        1=>'慢-快-慢，默认','匀速','低速开始','低速结束','低速开始和结束',/*'贝塞尔函数自定义',*/
    ];
    //record：timelong，func，delay

    /**
     * 获得产品信息
     */
    public function getProduct($pro_id=null)
    {
        $pro_id = $pro_id ? $pro_id : $this->productid;
        $productModel = ProductModel::find($pro_id);
        return $productModel ? $productModel : '';
    }

    public function getProductName()
    {
        return $this->getProduct() ? $this->getProduct()->name : '';
    }

    public function getFunc()
    {
        return array_key_exists($this->func,$this->funcs) ? $this->funcs[$this->func] : '';
    }

    public function getFuncName()
    {
        return array_key_exists($this->func,$this->funcNames) ? $this->funcNames[$this->func] : '';
    }

    /**
     * 获取动画关键帧
     */
    public function getLayerAttrs($attrSel=null)
    {
        if ($attrSel) {
            $datas = ProductLayerAttrModel::where('productid',$this->productid)
                ->where('layerid',$this->id)
                ->where('attrSel',$attrSel)
                ->get();
        } else {
            $datas = ProductLayerAttrModel::where('productid',$this->productid)
                ->where('layerid',$this->id)
                ->get();
        }
        return $datas;
    }

    /**
     * 获得动画的属性名
     */
    public function getAttrStyleName()
    {
        return ProductAttrModel::where('layerid',$this->id)->first()->style_name;
    }
}