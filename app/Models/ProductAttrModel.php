<?php
namespace App\Models;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_products_attr';
    protected $fillable = [
        'id','name','style_name','productid','uid','attrs',
//        'ismargin','margin','ispadding','padding','width','height','border','color','font_size','word_spacing','line_height','text_transform','text_align','background','position','left','top','overflow','opacity',
        'img','text','intro','pid','del','created_at','updated_at',
    ];
    //attrs：ismargin，margin1，margin2，margin3，margin4，margin5，margin6，ispadding，ispadding1，ispadding2，ispadding3，ispadding4，ispadding5，ispadding6，width，height，border1，border2，border3，border4，color，font_size，word_spacing，line_height，text_transform，text_align，background，left，top，overflow，opacity，
    //img图片：pic_id，pic_margin1，pic_margin2，pic_padding1，pic_padding2，pic_border1，pic_border2，pic_border,3，pic_border,4，pic_width，pic_height，
    //text文字：text_con，text_margin1，text_margin2，text_padding1，text_padding2，text_border1，text_border2，text_border3，text_border4，text_font_size，text_color，

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
        return $border1?$this->borderDirection[$border1]:'';
    }

    public function borderType($border3)
    {
        return array_key_exists($border3,$this->borderTypes)?$this->borderTypes[$border3]:'';
    }

    public function borderTypeName($border3)
    {
        return $border3?$this->borderTypeNames[$border3]:'';
    }

    public function border()
    {
        $borders = $this->border?explode('-',$this->border):[];
        if ($borders) {
            $border[] = $this->borderDirection($borders[0]);
            $border[] = $borders[1].'px';
            $border[] = $this->borderType($borders[3]);
            $border[] = $borders[3];
        }
        return isset($border) ? implode(',',$border) : '未定义';
    }

    public function textTransform()
    {
        return array_key_exists($this->text_transform,$this->textTransformTypes) ? $this->textTransformTypes[$this->text_transform] : '';
    }

    public function textTransformName($text_transform)
    {
        return array_key_exists($text_transform,$this->textTransformTypeNames) ? $this->textTransformTypeNames[$text_transform] : '';
    }

    public function textAlign()
    {
        return array_key_exists($this->text_align,$this->textAlignTypes) ? $this->textAlignTypes[$this->text_align] : '未定义';
    }

    public function textAlignName($text_align)
    {
        return array_key_exists($text_align,$this->textAlignTypeNames) ? $this->textAlignTypeNames[$text_align] : '未定义';
    }

    public function positionType()
    {
        return array_key_exists($this->position,$this->positionTypes) ? $this->positionTypes[$this->position] : '';
    }

    public function positionTypeName($position)
    {
        return array_key_exists($position,$this->positionTypeNames) ? $this->positionTypeNames[$position] : '';
    }

    public function positionName()
    {
        return array_key_exists($this->position,$this->positionTypeNames) ? $this->positionTypeNames[$this->position] : '未定义';
    }

    public function overflow()
    {
        return $this->overflow ? $this->overflowTypes[$this->overflow] : '未定义';
    }

    public function overflowName($overflow)
    {
        return $overflow ? $this->overflowTypeNames[$overflow] : '未定义';
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

    public function pic($pic_id)
    {
        return $pic_id ? PicModel::find($pic_id)->url : '';
    }
}