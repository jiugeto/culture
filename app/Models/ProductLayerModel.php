<?php
namespace App\Models;

class ProductLayerModel extends BaseModel
{
    protected $table = 'bs_products_layer';
    protected $fillable = [
        'id','name','layer_name','productid','attrid','conStr','layerAttr','animation_name','duration','function','delay','count','direction','state','mode','field','per','value','intro','del','created_at','updated_at',
    ];
    //速度曲线
    protected $functions = [
        1=>'linear','ease','ease-in','ease-out','ease-in-out','cubic-bezier',
    ];
    protected $functionNames = [
        1=>'匀速','默认，先慢再快后慢','低速开始','低速结束','低速开始和结束','贝塞尔函数自定义',
    ];
    //播放方向
    protected $directions = [
        1=>'normal','alternate',
    ];
    protected $directionNames = [
        1=>'正常','轮流反向',
    ];
    //播放状态
    protected $states = [
        'paused','running',
    ];
    protected $stateNames = [
        '暂停','播放',
    ];
    //播放模式
    protected $modes = [
        1=>'forwards','backwards','both','none',
    ];
    protected $modeNames = [
        1=>'保持最后画面','保持最开始画面','所有','复原',
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
        return isset($pname) ? $pname : '未知';
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
        return isset($attrname) ? $attrname : '未知';
    }

    public function func()
    {
        return array_key_exists($this->function,$this->functions) ? $this->functions[$this->function] : '';
    }

    public function functionName()
    {
        return array_key_exists($this->function,$this->functionNames) ? $this->functionNames[$this->function] : '';
    }

    public function direction()
    {
        return array_key_exists($this->direction,$this->directions) ? $this->directions[$this->direction] : '';
    }

    public function directionName()
    {
        return array_key_exists($this->direction,$this->directionNames) ? $this->directionNames[$this->direction] : '';
    }

    public function state()
    {
        return array_key_exists($this->state,$this->states) ? $this->states[$this->state] : '';
    }

    public function stateName()
    {
        return array_key_exists($this->state,$this->stateNames) ? $this->stateNames[$this->state] : '';
    }

    public function mode()
    {
        return array_key_exists($this->mode,$this->modes) ? $this->modes[$this->mode] : '';
    }

    public function modeName()
    {
        return array_key_exists($this->mode,$this->modeNames) ? $this->modeNames[$this->mode] : '';
    }

    /**
     * 以下是换种方式
     */
    public function getFunc($function)
    {
        return array_key_exists($function,$this->functions) ? $this->functions[$function] : '';
    }

    public function geFunctionName($function)
    {
        return array_key_exists($function,$this->functionNames) ? $this->functionNames[$function] : '';
    }

    public function getDirection($direction)
    {
        return array_key_exists($direction,$this->directions) ? $this->directions[$direction] : '';
    }

    public function getDirectionName($direction)
    {
        return array_key_exists($direction,$this->directionNames) ? $this->directionNames[$direction] : '';
    }

    public function getState($state)
    {
        return array_key_exists($state,$this->states) ? $this->states[$state] : '';
    }

    public function getStateName($state)
    {
        return array_key_exists($state,$this->stateNames) ? $this->stateNames[$state] : '';
    }

    public function getMode($mode)
    {
        return array_key_exists($mode,$this->modes) ? $this->modes[$mode] : '';
    }

    public function getModeName($mode)
    {
        return array_key_exists($mode,$this->modeNames) ? $this->modeNames[$mode] : '';
    }

    /**
     * 动画内容，图片文字
     */
    public function cons()
    {
        $array = $this->conStr ? explode(',',$this->conStr) : [];
        if ($array) {
            array_filter($array); sort($array);
            $conModels = ProductConModel::whereIn('conStr',$array)->get();;
        }
        return isset($conModels) ? $conModels : [];
    }

    /**
     * 动画点的属性
     */
    public function layerAttrs()
    {
        $layerAttrs = $this->layerAttr ? explode(',',$this->layerAttr) : [];
        if ($layerAttrs) {
            array_filter($layerAttrs); sort($layerAttrs);
            $layerAttrModels = ProductLayerAttrModel::whereIn('id',$layerAttrs)->get();
        }
        return isset($layerAttrModels) ? $layerAttrModels : [];
    }
}