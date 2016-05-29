<?php
namespace App\Models;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_products_attr';
    protected $fillable = [
        'id','name','style_name','productid','uid','attrs','attrs2','attrs3','img','text','intro','del','created_at','updated_at',
    ];
    //attrs：switch，ismargin，margin1，margin2，margin3，margin4，margin5，margin6，ispadding，ispadding1，ispadding2，ispadding3，ispadding4，ispadding5，ispadding6，width，height，border1，border2，border3，border4，iscolor，color，font_size，word_spacing，line_height，text_transform，text_align，isbackground，background，position,left，top，overflow，opacity，
    //attrs2：switch2，ismargin，margin1，margin2，margin3，margin4，margin5，margin6，ispadding，ispadding1，ispadding2，ispadding3，ispadding4，ispadding5，ispadding6，width，height，border1，border2，border3，border4，iscolor，color，font_size，word_spacing，line_height，text_transform，text_align，isbackground，background，position,left，top，overflow，opacity，updated_at，
    //attrs3：switch3，ismargin，margin1，margin2，margin3，margin4，margin5，margin6，ispadding，ispadding1，ispadding2，ispadding3，ispadding4，ispadding5，ispadding6，width，height，border1，border2，border3，border4，iscolor，color，font_size，word_spacing，line_height，text_transform，text_align，isbackground，background，position,left，top，overflow，opacity，updated_at，
    //text文字：switch4，ismargin，margin1，margin2，margin3，margin4，margin5，margin6，ispadding，padding1，padding2，border1，border2，border3，border4，iscolor，color，isbackground，background，font_size，word_spacing，line_height，updated_at，
    //img图片：switch5，ismargin，margin1，margin2，margin3，margin4，ispadding，padding1，padding2，padding3，padding4，border1，border2，border3，border4，width，height，updated_at，

    //边框类型
    protected $borderDirections = [
        'none','top','right','bottom','left','',
    ];
    protected $borderDirectionNames = [
        '无','顶部','右边','底部','左边','四面',
    ];
    protected $borderTypes = [
        'none','dotted','dashed','solid','double','groove','ridge','inset','outset',
    ];
    protected $borderTypeNames = [
        '无边框','点线','虚线','实线边框','双线边框','3D凹槽','3D凸槽','3D凹边','3D凸边',
    ];
    //字的变换
    protected $textTransformTypes = [
        1=>'none','capitalize','uppercase','lowercase','inherit',
    ];
    protected $textTransformTypeNames = [
        1=>'无','单词开头字母大写','字母大写','字母小写','继承上级',
    ];
    //字的水平对齐
    protected $textAlignTypes = [
        '','left','center','right',
    ];
    protected $textAlignTypeNames = [
        '无','左','中','右',
    ];
    //定位方式
    protected $positionTypes = [
        1=>'static','absolute','fixed','relative','inherit',
    ];
    protected $positionTypeNames = [
        1=>'无','绝对定位(相对于第一个父级)','绝对定位(相对于浏览器)','相对定位','继承上级',
    ];
    //裁剪方式
    protected $overflowTypes = [
        1=>'visible','hidden','scroll','auto','inherit',
    ];
    protected $overflowTypeNames = [
        1=>'无','内容修剪','内容修剪，但可滚动查看','如果内容修剪，可滚动查看','继承上级',
    ];
    //外类型边框
    protected $marginTypes = [
        1=>'无','上下左右居中','上下居中，左右自定义','左右居中，上下自定义','完全自定义',
    ];

    public function productAll()
    {
        return ProductModel::all();
    }

    public function products()
    {
        $userid = isset($this->userid) ? $this->userid : 0;
        $productModels = ProductModel::where('uid',$userid)->get();
        return $productModels ? $productModels : [];
    }

    public function product()
    {
        $productModel = ProductModel::find($this->productid);
        if ($productModel) { $pname = $this->productid ? $productModel->name : ''; }
        return isset($pname) ? $pname : '';
    }

    public function parents()
    {
        return ProductAttrModel::where('pid',0)->get();
    }

    public function parent()
    {
        return $this->pid ? ProductAttrModel::find($this->pid) : '已是顶级属性';
    }

    public function borderDirection($border1)
    {
        return array_key_exists($border1,$this->borderDirections)?$this->borderDirections[$border1]:'';
    }

    public function borderType($border3)
    {
        return array_key_exists($border3,$this->borderTypes)?$this->borderTypes[$border3]:'';
    }

    public function borderTypeName($border3)
    {
        return $border3?$this->borderTypeNames[$border3]:'';
    }

//    public function border()
//    {
//        $borders = $this->border?explode('-',$this->border):[];
//        if ($borders) {
//            $border[] = $this->borderDirection($borders[0]);
//            $border[] = $borders[1].'px';
//            $border[] = $this->borderType($borders[3]);
//            $border[] = $borders[3];
//        }
//        return isset($border) ? implode(',',$border) : '未定义';
//    }

    public function textTransform($text_transform)
    {
        $text_transform = $text_transform ? $text_transform : 1;
        return array_key_exists($text_transform,$this->textTransformTypes) ? $this->textTransformTypes[$text_transform] : '未定义';
    }

    public function textTransformName($text_transform)
    {
        return array_key_exists($text_transform,$this->textTransformTypeNames) ? $this->textTransformTypeNames[$text_transform] : '未定义';
    }

    public function textAlign($text_align)
    {
        $text_align = $text_align ? $text_align : 0;
        return array_key_exists($text_align,$this->textAlignTypes) ? $this->textAlignTypes[$text_align] : '未定义';
    }

    public function textAlignName($text_align)
    {
        return array_key_exists($text_align,$this->textAlignTypeNames) ? $this->textAlignTypeNames[$text_align] : '未定义';
    }

    public function positionType($position)
    {
        $position = $position ? $position : 1;
        return array_key_exists($position,$this->positionTypes) ? $this->positionTypes[$position] : '未定义';
    }

    public function positionTypeName($position)
    {
        $position = $position ? $position : 1;
        return array_key_exists($position,$this->positionTypeNames) ? $this->positionTypeNames[$position] : '未定义';
    }

    public function positionName($position)
    {
        $position = $position ? $position : 0;
        return array_key_exists($position,$this->positionTypeNames) ? $this->positionTypeNames[$position] : '未定义';
    }

    public function overflow($overflow)
    {
        $overflow = $overflow ? $overflow : 1;
        return $overflow ? $this->overflowTypes[$overflow] : '未定义';
    }

    public function overflowName($overflow)
    {
        $overflow = $overflow ? $overflow : 1;
        return array_key_exists($overflow,$this->overflowTypeNames) ? $this->overflowTypeNames[$overflow] : '未定义';
    }

    //图片
    public function picAll()
    {
        return PicModel::all();
    }

    public function pics($uid)
    {
        return PicModel::where('uid',$uid)->get();
    }

    public function picName($pic_id)
    {
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel->name : '';
    }

    public function picUrl($pic_id)
    {
        $picModel = PicModel::find($pic_id);
        return $picModel ? $picModel->url : '';
    }




    /**
     *=====
     *改造后
     *=====
     */

    //总的属性
    public function attrs()
    {
        return $this->attrs ? unserialize($this->attrs) : [];
    }

    //总的属性2
    public function attrs2()
    {
        return $this->attrs2 ? unserialize($this->attrs2) : [];
    }

    //总的属性2
    public function attrs3()
    {
        return $this->attrs3 ? unserialize($this->attrs3) : [];
    }

    //文字属性
    public function textAttr()
    {
        return $this->text ? unserialize($this->text) : [];
    }

    //图片属性
    public function picAttr()
    {
        return $this->img ? unserialize($this->img) : [];
    }

    //内容
    public function cons()
    {
        $productid = $this->productid ? $this->productid : 0;
        $attrid = $this->id ? $this->id : 0;
        return ProductConModel::where('productid',$productid)
            ->where('attrid',$attrid)
            ->where('isshow',1)
            ->where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','asc')
            ->get();
    }

    //动画调节
    public function layers()
    {
        $productid = $this->productid ? $this->productid : 0;
        $attrid = $this->id ? $this->id : 0;
        return ProductLayerModel::where('productid',$productid)
            ->where('attrid',$attrid)
            ->where('del',0)
            ->get();
    }

    //动画属性
    public function layerAttrs()
    {
        $productid = $this->productid ? $this->productid : 0;
        $attrid = $this->id ? $this->id : 0;
        return ProductLayerAttrModel::where('productid',$productid)
            ->where('attrid',$attrid)
            ->where('del',0)
            ->orderBy('per','asc')
            ->get();
    }
}