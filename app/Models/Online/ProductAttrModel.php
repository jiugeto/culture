<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_pro_attr';
    protected $fillable = [
        'id','name','style_name','productid','genre','parent',
        'padding','size','pos','float','opacity','text',
        'created_at','updated_at',
    ];

    //每个层确定为定位专用、动画专用
    protected $genres = [
        1=>'开始层','定位层','动画层',
    ];
    //内边距类型选择
    protected $padTypes = [
        '无','上下左右一致','上下一致，左右一致','上、下、左、右分离',
    ];
    //定位方式选择
    protected $posTypes = [
        '无','相对定位',
    ];
    //浮动方式选择
    protected $floats = [
        '无','左浮动','右浮动',
    ];

    /**
     * 以下几个文字属性
     */
    protected $colors = [
        '','1','black','white','red','green','blue','yellow',
    ];
    protected $colorNames = [
        '无','自定义','黑','白','红','绿','蓝','黄',
    ];
    protected $textAlignTypes = [
        '','left','center','right',
    ];
    protected $textAlignNames = [
        '无','左','中','右',
    ];

    public function getGenreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    /**
     * 得到该产品信息
     */
    public function getProduct()
    {
        $productModel = ProductModel::find($this->productid);
        return $productModel ? $productModel : '';
    }

    /**
     * 得到该产品同用户名下所有产品
     */
    public function getUserProducts()
    {
        $uid = $this->getProduct() ? $this->getProduct()->uid : 0;
        return ProductModel::where('uid',$uid)->get();
    }

    /**
     * 得到该产品名称
     */
    public function getProductName()
    {
        return $this->getProduct() ? $this->getProduct()->name : '';
    }

    /**
     * 内边距
     */
    public function getPadding()
    {
        if (!$this->padding) {
            $pad['k'] = 0;
            $pad['v'] = '无内边距';
        } else {
            $pads = explode(',',$this->padding);
            if (count($pads)==1) {
                $pad['k'] = 1;
                $pad['v'] = $pads[0];
            } elseif (count($pads)==2) {
                $pad['k'] = 2;
                $pad['v'] = $pads[0].'，'.$pads[1];
            } elseif (count($pads)==3) {
                $pad['k'] = 3;
                $pad['v'] = $pads[0].'，'.$pads[1].'，'.$pads[2].'，'.$pads[3];
            }
        }
        return $pad;
    }

    /**
     * 内边距类型
     */
    public function getPadType()
    {
        return $this->getPadding()['k'];
    }

    /**
     * 内边距值
     */
    public function getPadVal()
    {
        return $this->getPadding()['v'];
    }

    /**
     * 内边距几个边的值
     */
    public function getPadVal2($k)
    {
        $vals = $this->getPadVal();
        if ($k==1) {
            $v = $vals;
        } else {
            $v = explode('，',$vals);
        }
        return $v;
    }

    /**
     * 得到宽高
     */
    public function getSize()
    {
        return explode(',',$this->size);
    }

    public function getWidth()
    {
        return $this->getSize()[0] ? $this->getSize()[0] : '';
    }

    public function getHeight()
    {
        return $this->getSize()[1] ? $this->getSize()[1] : '';
    }

    /**
     * 定位方式
     */
    public function getPos()
    {
        $posArr = explode(',',$this->pos);
        if ($posArr[0]==0) {
            $pos['pos'] = $this->posTypes[$posArr[0]];
            $pos['left'] = '';
            $pos['top'] = '';
        } elseif ($posArr[0]==1) {
            $pos['pos'] = $this->posTypes[$posArr[0]];
            $pos['left'] = $posArr[1] ? $posArr[1] : '';
            $pos['top'] = $posArr[2] ? $posArr[2] : '';
        }
        $pos['type'] = $posArr[0];
        return $pos;
    }

    /**
     * 定位类型
     */
    public function getPosType()
    {
        return $this->getPos()['type'];
    }

    /**
     * 浮动方式
     */
    public function getFloat()
    {
        return array_key_exists($this->float,$this->floats) ? $this->floats[$this->float] : '';
    }

    /**
     * 透明度
     */
    public function getOpacity()
    {
        $opacityArr = explode(',',$this->opacity);
        if ($opacityArr[0]) {
            $opacity = $opacityArr[1];
        }
        return ($opacityArr&&isset($opacity)) ? $opacity : '无';
    }

    /**
     * 获取父级属性
     */
    public function getParent()
    {
        return ProductAttrModel::find($this->parent);
    }

    /**
     * 获取父级属性名称
     */
    public function getParentName()
    {
        return $this->getParent() ? $this->getParent()->name : '/';
    }

    /**
     * 获取子级属性
     */
    public function getSub($genre)
    {
        return ProductAttrModel::where('parent',$this->id)->where('genre',$genre)->first();
    }

//    /**
//     * 获取子级属性定位层名称
//     */
//    public function getSubName()
//    {
//        return $this->getSub(2) ? $this->getSub(2)->name : '';
//    }
//
//    /**
//     * 获取子级属性动画层名称
//     */
//    public function getSubName2()
//    {
//        return $this->getSub(3) ? $this->getSub(3)->name : '';
//    }

    /**
     * 获取该属性的动画设置
     */
    public function getLayer()
    {
        $attrid = $this->getSub(3) ? $this->getSub(3)->id : 0;
        return ProductLayerModel::where('attrid',$attrid)->first();
    }

    /**
     * 获取该属性的动画设置
     */
    public function getConList()
    {
        return ProductConModel::where('attrid',$this->id)->get();
    }
}