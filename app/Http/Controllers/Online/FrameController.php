<?php
namespace App\Http\Controllers\Online;

use Illuminate\Http\Request;
use App\Models\PicModel;
use App\Models\ProductModel;
use App\Models\ProductAttrModel;
use App\Models\ProductLayerModel;
use App\Models\ProductConModel;
use App\Models\ProductLayerAttrModel;

class FrameController extends BaseController
{
    /**
     * 在线创作 单帧管理
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index($productid)
    {
        $result = [
            'data'=> $this->product($productid),
            'cons'=> $this->cons($productid),
            'attrs'=> $this->attrs($productid),
            'layers'=> $this->layers($productid),
            'layerAttrs'=> $this->layerAttrs($productid),
            'pics'=> PicModel::where('uid',$this->userid)->where('del',0)->get(),
            'footSwitch'=> \App\Models\UserParamsModel::where('uid',$this->userid)
                                            ->first()
                                            ->foot_switch,
            'attrModel'=> new ProductAttrModel(),
            'layerModel'=> new ProductLayerModel(),
            'layerAttrModel'=> new ProductLayerAttrModel(),
            'conModel'=> new ProductConModel(),
        ];
        return view('online.frame.edit', $result);
    }

    public function setCon(){}

    public function setStyle(){}

    public function setLayer(){}

    public function setTimeCurr($productid,$layerid)
    {
        ProductLayerModel::where('productid',$productid)->update(['timeCurr'=> 0]);
        ProductLayerModel::where('id',$layerid)->update(['timeCurr'=> 1]);
        return redirect('/online/'.$productid.'/frame');
    }

    public function setTimeCurr2($productid,$timecurr)
    {
        ProductModel::where('id',$productid)->update(['timeCurr'=> $timecurr]);
        return redirect('/online/'.$productid.'/frame');
    }




    /**
     * 以下是查询方法
     */

    public function product($productid)
    {
        return ProductModel::find($productid);
    }

    public function cons($productid)
    {
        return ProductConModel::where('productid',$productid)
            ->where('del',0)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->get();
    }

    public function attrs($productid)
    {
        $uid = $this->userid ? $this->userid : 0;
        return ProductAttrModel::where('productid',$productid)
            ->where('del',0)
            ->where('uid',$uid)
            ->get();
    }

    public function layers($productid)
    {
        return ProductLayerModel::where('productid',$productid)
            ->where('del',0)
            ->get();
    }

    public function layerAttrs($productid)
    {
        return ProductLayerAttrModel::where('productid',$productid)
            ->where('del',0)
            ->get();
    }
}