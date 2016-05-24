<?php
namespace App\Http\Controllers\Online;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductAttrModel;
use App\Models\ProductLayerModel;
use App\Models\ProductConModel;

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
            'attrs'=> \App\Tools::childList2($this->attrs($productid)),
            'layers'=> $this->layers($productid),
            'pics'=> $this->pics($productid),
            'texts'=> $this->texts($productid),
        ];
        return view('online.frame.index', $result);
    }




    /**
     * 以下是查询方法
     */

    public function product($productid)
    {
        return ProductModel::find($productid);
    }

    public function attrs($productid)
    {
        $uid = $this->userid ? $this->userid : 0;
        return ProductAttrModel::where('productid',$productid)->where('del',0)->where('uid',$uid)->get();
    }

    public function layers($productid)
    {
        return ProductLayerModel::where('productid',$productid)->where('del',0)->get();
    }

    public function texts($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',2)->where('del',0)->get();
    }

    public function pics($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',1)->where('del',0)->get();
    }
}