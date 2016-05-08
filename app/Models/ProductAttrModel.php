<?php
namespace App\Models;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_products_attr';
    protected $fillable = [
        'id','name','layerid','type','val','intro','del','created_at','updated_at',
    ];

    //属性类型标识type：1(margin,padding)，2(width,height,border-radius)，3(color,background)，4(border)，5(position)，

    protected $attrs = [
        1=>'margin','padding','width','height',
        'border','border-radius','font-size','color',
        'background','position',
    ];
    protected $attrNames = [
        1=>'外边距','内边距','宽度','高度',
        '边框','边框圆角','文字大小','文字颜色',
        '背景','定位',
    ];
    protected $borderTypes = [
        1=>'none','hidden','dotted','dashed','solid',
        'double','groove','ridge','inset','outset',
    ];
    protected $borderTypeNames = [
        1=>'无轮廓','隐藏边框','点状轮廓','虚线轮廓','实线轮廓',
        '双线轮廓','3D凹槽轮廓','3D凸槽轮廓','3D凹边轮廓','3D凸边轮廓',
    ];
}