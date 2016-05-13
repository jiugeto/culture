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
//        dd($urls);
        $result = [
            'data'=> $this->product($productid),
            'attrs'=> \App\Tools::childList2($this->attrs($productid)),
            'layers'=> $this->layers($productid),
            'pics'=> $this->pics($productid),
            'texts'=> $this->texts($productid),
            'restart'=> $restart,
        ];
//        dd(\App\Tools::childList2($this->attrs($productid)));
        return view('online.home.index', $result);
//        return view('online.home.test2', $result);
    }

    public function product($id)
    {
        return ProductModel::find($id);
    }

    public function attrs($productid)
    {
        //属性数据转换
        $datas = ProductAttrModel::where('productid',$productid)->get();
        $model = new ProductAttrModel();
        foreach ($datas as $data) {
//            $data->style_name = substr($data->style_name,5,strlen($data->style_name)-1);
            if ($data->margin) {
                $margins = explode('-',$data->margin);
                $data->margin1 = $margins[0]=='auto'?'':$margins[0];
                $data->margin2 = $margins[1]=='auto'?'':$margins[1];
            }
            if ($data->padding) {
                $paddings = explode('-',$data->padding);
                $data->padding1 = $paddings[0]=='auto'?'':$paddings[0];
                $data->padding2 = $paddings[1]=='auto'?'':$paddings[1];
            }
            if ($data->border) {
                $borders = explode('-',$data->border);
                $data->border1 = $borders[0];
                $data->border2 = $borders[1];
                $data->border3 = $borders[2];
                $data->border4 = $borders[3];
            }
        }
//        dd($datas);
        return $datas;
    }

    public function layers($productid)
    {
        return ProductLayerModel::where('productid',$productid)->get();
    }

    public function pics($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',1)->get();
    }

    public function texts($productid)
    {
        return ProductConModel::where('productid',$productid)->where('genre',2)->get();
    }
}