<?php
namespace App\Models;

class ProductConModel extends BaseModel
{
    /**
     * 产品动画的图片文字管理
     */

    protected $table = 'bs_products_con';
    protected $fillable = [
        'id','name','productid','attrid','genre','pic_id','attrs','text_attr','intro','del','created_at','updated_at',
    ];
    protected $genres = [1=>'图片','文字'];
    //attrs：ismargin，margin1，margin2，margin3，margin4，ispadding，padding1，padding2，padding3，padding4，width，height，border1，border2，border3，border4，background，position，left，top，overflow，opacity

    //边框位置
    protected $borderDirections = [
        '','top','right','bottom','left','all',
    ];
    protected $borderDirectionNames = [
        '无','顶部','右边','底部','左边','四面',
    ];
    //边框类型
    protected $borderTypes = [
        'none','dotted','dashed','solid','double','groove','ridge','inset','outset',
    ];
    protected $borderTypeNames = [
        '无边框','点线','虚线','实线边框','双线边框','3D凹槽','3D凸槽','3D凹边','3D凸边',
    ];
    //字的变换
    protected $textTransformTypes = [
        'none','capitalize','uppercase','lowercase','inherit',
    ];
    protected $textTransformTypeNames = [
        '无','单词开头字母大写','字母大写','字母小写','继承上级',
    ];
    //字的水平对齐
    protected $textAlignTypes = [
        'none','capitalize','uppercase','lowercase','inherit',
    ];
    protected $textAlignTypeNames = [
        '无','单词开头字母大写','字母大写','字母小写','继承上级',
    ];
    //定位方式
    protected $positionTypes = [
        'static','absolute','fixed','relative','inherit',
    ];
    protected $positionTypeNames = [
        '无','绝对定位(相对于第一个父级)','绝对定位(相对于浏览器)','相对定位','继承上级',
    ];
    //裁剪方式
    protected $overflowTypes = [
        'visible','hidden','scroll','auto','inherit',
    ];
    protected $overflowTypeNames = [
        '无','内容修剪','内容修剪，但可滚动查看','如果内容修剪，可滚动查看','继承上级',
    ];
    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '';
    }
    public function attrAll()
    {
        return ProductAttrModel::all();
    }
    public function attrs()
    {
        $uid = \Session::has('user.uid')?\Session::get('user.uid'):0;
        return ProductAttrModel::where('uid',$uid)->get();
    }
    public function attr()
    {
        return $this->attrid ? ProductAttrModel::find($this->attrid)->name : '';
    }
    public function productAll()
    {
        return ProductModel::all();
    }

    public function products()
    {
        $uid = \Session::has('user.uid')?\Session::get('user.uid'):0;
        return ProductModel::where('uid',$uid)->get();
    }

    public function product()
    {
        $productModel = ProductModel::find($this->productid);
        if ($productModel) { $pname = $this->productid ? $productModel->name : ''; }
        return isset($pname) ? $pname : '';
    }

    public function borderDirection($border1)
    {
        return $border1?$this->borderDirection[$border1]:'';
    }

    public function borderDirectionName($border1)
    {
        return $border1?$this->borderDirectionNames[$border1]:'';
    }

    public function borderType($border3)
    {
        return $border3?$this->borderTypes[$border3]:'';
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
        return $this->text_transform ? $this->textTransformTypes[$this->text_transform] : '未定义';
    }

    public function textAlign($textAlign)
    {
        return array_key_exists($textAlign,$this->textAlignTypeNames) ? $this->textAlignTypeNames[$textAlign] : '未定义';
    }

    public function position()
    {
        return array_key_exists($this->position,$this->positionTypeNames) ? $this->positionTypeNames[$this->position] : '未定义';
    }

    public function overflow()
    {
        return array_key_exists($this->overflow,$this->overflowTypeNames) ? $this->overflowTypeNames[$this->overflow] : '未定义';
    }

    //图片
    public function picAll()
    {
        return PicModel::all();
    }

    public function pics()
    {
        $uid = \Session::has('user.uid')?\Session::get('user.uid'):0;
        return PicModel::where('uid',$uid)->get();
    }

    public function pic()
    {
        $picModel = PicModel::find($this->pic_id);
//        return $this->pic_id ? PicModel::find($this->pic_id) : '';
        return isset($picModel) ? $picModel : '';
    }

    public function picurl()
    {
        $picModel = PicModel::find($this->pic_id);
//        return $this->pic_id ? PicModel::find($this->pic_id) : '';
        return isset($picModel) ? $picModel->url : '';
    }

    public function picname()
    {
        $picModel = PicModel::find($this->pic_id);
//        return $this->pic_id ? PicModel::find($this->pic_id) : '';
        return isset($picModel) ? $picModel->name : '';
    }

    public function getPicName($pic_id)
    {
        $picModel = PicModel::find($pic_id);
        return isset($picModel) ? $picModel->name : '';
    }

    public function getPicUrl($pic_id)
    {
        $picModel = PicModel::find($pic_id);
        return isset($picModel) ? $picModel->url : '';
    }

    //图片样式
    public function picAttrs()
    {
        return $this->pic_attr ? unserialize($this->pic_attr) : [];
    }

    //图片样式
    public function textAttrs()
    {
        return $this->text_attr ? unserialize($this->text_attr) : [];
    }
}