<?php
namespace App\Http\Controllers\Online;

use App\Models\ProductAttrModel;
use App\Models\ProductConModel;
use App\Models\ProductLayerModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    /**
     * 在线创作窗口主页
     */

    public function index($productid=1)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        $restart = $urls[count($urls)-1]=='restart'?1:0;
        $result = [
            'data'=> $this->product($productid),
            'attrs'=> $this->attrs($productid),
            'layers'=> $this->layers($productid),
            'pics'=> $this->pics($productid),
            'texts'=> $this->texts($productid),
            'restart'=> $restart,
        ];
//        dd(\App\Tools::childList2($this->attrs($productid)));
        return view('online.home.index', $result);
    }




    /**
     * 以下是要展示的数据
     */

    public function product($id)
    {
        return ProductModel::find($id);
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
        return ProductLayerModel::where('productid',$productid)->where('del',0)->get();
    }

    public function pics($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',1)->where('del',0)->get();
    }

    public function texts($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',2)->where('del',0)->get();
    }
}