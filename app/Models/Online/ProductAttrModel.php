<?php
namespace App\Models\Online;

use App\Models\Base\BaseModel;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_pro_attr';
    protected $fillable = [
        'id','name','style_name','productid','layerid','genre',
        'padding','size','pos','float','opacity','border','bg','text',
        'record','created_at','updated_at',
    ];

    //定位、定位、动画
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
    //浮动方式
    protected $floatTypes = [
        '','left','right',
    ];
    //浮动方式选择
    protected $floats = [
        '无','左浮动','右浮动',
    ];
    //边框类型
    protected $borderTypes = [
        1=>'dotted','dashed','solid',
    ];
    //边框名称
    protected $borderTypeNames = [
        1=>'实线','点状','虚线',
    ];
    //边框类型
    protected $borderColors = [
        1=>'lightgrey','grey','black','white','red','green','blue',
    ];
    //边框名称
    protected $borderColorNames = [
        1=>'淡灰','灰色','黑色','白色','红色','绿色','蓝色',
    ];
    //record：padding，size，pos，float，opacity，border

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
     * 得到动画设置信息
     */
    public function getLayer()
    {
        $layerModel = ProductLayerModel::find($this->layerid);
        return $layerModel ? $layerModel : '';
    }

    /**
     * 得到该产品名称
     */
    public function getLayerName()
    {
        return $this->getLayer() ? $this->getLayer()->name : '';
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
    public function getPadVal2()
    {
        $padType = $this->getPadType();
        $pads = $this->padding ? explode(',',$this->padding) : '';
        if ($padType==1) {
            $val[0] = $pads[0];
        } elseif ($padType==2) {
            $val[0] = $pads[0];
            $val[1] = $pads[1];
        } elseif ($padType==3) {
            $val[0] = $pads[0];
            $val[1] = $pads[1];
            $val[2] = $pads[2];
            $val[3] = $pads[3];
        }
        return isset($val) ? $val : [];
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
     * 定位左边距
     */
    public function getPosLeft()
    {
        return $this->getPos()['left'];
    }

    /**
     * 定位顶边距
     */
    public function getPosTop()
    {
        return $this->getPos()['top'];
    }

    /**
     * 浮动方式
     */
    public function getFloat()
    {
        return array_key_exists($this->float,$this->floats) ? $this->floats[$this->float] : '';
    }

    /**
     * 浮动方式
     */
    public function getFloatType()
    {
        return array_key_exists($this->float,$this->floatTypes) ? $this->floatTypes[$this->float] : '';
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
        return ($opacityArr&&isset($opacity)) ? $opacity : 0;
    }

    /**
     * 边框判断
     */
    public function getIsBorder()
    {
        return explode(',',$this->border)[0];
    }

    /**
     * 边框中文信息
     */
    public function getBorderName()
    {
        $borders = explode(',',$this->border);
        if ($borders[0]) {
            $borderName = $borders[1].'px，'.$this->borderTypeNames[$borders[2]].'，'.$this->borderColorNames[$borders[3]];
        }
        return isset($borderName) ? $borderName : '无';
    }

    /**
     * 边框英文信息
     */
    public function getBorder()
    {
        $borders = explode(',',$this->border);
        if ($borders[0]) {
            $border = $borders[1].'px,'.$this->borderTypes[$borders[2]].','.$this->borderColors[$borders[3]];
        }
        return isset($border) ? $border : '';
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
}