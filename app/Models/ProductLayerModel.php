<?php
namespace App\Models;

class ProductLayerModel extends BaseModel
{
    protected $table = 'bs_products_layer';
    protected $fillable = [
        'id','name','productid','attrid','animation_name','duration','function','delay','count','direction','state','mode','field','per','value','intro','del','created_at','updated_at',
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

    public function products($uid)
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

    public function attrs($uid)
    {
        return ProductAttrModel::where('uid',$uid)->get();
    }

    public function attrname()
    {
        if ($this->attrid) {
            $attrModel = ProductAttrModel::find($this->attrid);
            if ($attrModel) { $attrname = $attrModel->name; }
        }
        return isset($attrname) ? $attrname : '未知';
    }

    public function func()
    {
        return $this->function ? $this->functions[$this->function] : '';
    }

    public function functionName()
    {
        return $this->function ? $this->functionNames[$this->function] : '';
    }

    public function direction()
    {
        return $this->direction ? $this->directions[$this->direction] : '';
    }

    public function directionName()
    {
        return $this->direction ? $this->directionNames[$this->direction] : '';
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
        return $this->mode ? $this->modes[$this->mode] : '';
    }

    public function modeName()
    {
        return $this->mode ? $this->modeNames[$this->mode] : '';
    }

    public function fields()
    {
        $fields = $this->field ? explode('|',$this->field) : [];
        unset($fields[count($fields)-1]);
        return $fields;
    }

    public function pers()
    {
        $pers = $this->per ? explode('|',$this->per) : [];
        unset($pers[count($pers)-1]);
        return $pers;
    }

    public function values()
    {
        $values = $this->value ? explode(',',$this->value) : [];
        if ($values) {
            foreach ($values as $k=>$value) {
                $value = $value ? explode('|',$value) : [];
                unset($value[count($value)-1]);
                if ($value) { $vals[$k] = $value; }
            }
        }
        return isset($vals) ? $vals : [];
    }
}