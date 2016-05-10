<?php
namespace App\Http\Controllers\Online;

use App\Models\ProductAttrModel;
use App\Models\ProductLayerModel;
use App\Models\ProductModel;

class HomeController extends BaseController
{
    /**
     * 在线创作窗口主页
     */

    public function index($productid=1)
    {
        $result = [
            'data'=> $this->product($productid),
            'attrs'=> $this->attrs($productid),
            'layers'=> $this->layers($productid),
        ];
//        dd($this->product($productid),$this->attrs($productid),$this->layers($productid));
        return view('online.home.index', $result);
    }

    public function product($id)
    {
        return ProductModel::find($id);
    }

    public function attrs($productid)
    {
        return ProductAttrModel::where('productid',$productid)->get();
    }

    public function layers($productid)
    {
        return ProductLayerModel::where('productid',$productid)->get();
    }
}