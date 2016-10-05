<?php
namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use App\Models\Online\ProductLayerAttrModel;
use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductModel;
use App\Models\Online\OrderProductModel;

class BaseController extends Controller
{
    /**
     * 在线创作窗口基础控制器
     */

    protected $prefix_attr = 'attr_';
    protected $prefix_layer = 'layer_';
    protected $attrModel;
    protected $layerModel;
    protected $layerAttrModel;
    protected $orderProModel;

    public function __construct()
    {
        parent::__construct();
        $this->userid = \Session::has('user.uid') ? \Session::get('user.uid') : redirect('/login');
        $this->model = new ProductModel();
        $this->attrModel = new ProductAttrModel();
        $this->layerModel = new ProductLayerModel();
        $this->layerAttrModel = new ProductLayerAttrModel();
        $this->orderProModel = new OrderProductModel();
    }






    /**
     * 动画预览
     */
    public function play($productid)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        $result = [
            'currUrl'=> $urls[count($urls)-1],
            'layers'=> $this->getLayers($productid),
            'attrs'=> $this->getAttrs($productid,0),
            'layerAttrs'=> $this->getLayerAttrs($productid,0),
            'layerAttrModel'=> $this->layerAttrModel,
            'cons'=> $this->getCons($productid,0),
        ];
        return view('online.pre.index', $result);
    }

    /**
     * 动画编辑
     */
    public function play2($productid,$layerid,$con_id,$genre)
    {
        $result = [
            'data'=> ProductModel::find($productid),
            'layers'=> $this->getLayers($productid),
            'cons'=> $this->getCons($productid,$layerid),
            'attrs'=> $this->getAttrs($productid,$layerid),
            'attrModel'=> $this->attrModel,
        ];
        return view('online.frame.basic.index', $result);
    }

    /**
     * 获取该产品所有动画设置
     */
    public function getLayers($productid)
    {
        return ProductLayerModel::where('productid',$productid)
            ->orderBy('delay','asc')
            ->orderBy('id','asc')
            ->get();
    }

    /**
     * 获取属性
     */
    public function getAttrs($productid,$layerid)
    {
        if ($layerid) {
            $datas = ProductAttrModel::where('productid',$productid)
                ->where('layerid',$layerid)
                ->get();
        } else {
            $datas = ProductAttrModel::where('productid',$productid)->get();
        }
        return $datas;
    }

    /**
     * 获取图文内容
     */
    public function getCons($productid,$layerid)
    {
        if ($layerid) {
            $datas = ProductConModel::where('productid',$productid)
                ->where('layerid',$layerid)
                ->where('isshow',1)
                ->orderBy('id','desc')
                ->get();
        } else {
            $datas = ProductConModel::where('productid',$productid)
                ->where('isshow',1)
                ->orderBy('id','desc')
                ->get();
        }
        return $datas;
    }

    /**
     * 获取动画关键帧
     */
    public function getLayerAttrs($productid,$layerid)
    {
        if ($layerid) {
            $datas = ProductLayerAttrModel::where('productid',$productid)
                ->where('layerid',$layerid)
                ->get();
        } else {
            $datas = ProductLayerAttrModel::where('productid',$productid)->get();
        }
        return $datas;
    }

    /**
     * 获取一条动画记录
     */
    public function getOneLayer($productid,$layerid)
    {
        if ($layerid) {
            $layer = ProductLayerModel::find($layerid);
        } else {
            $layer = ProductLayerModel::where('productid',$productid)
                ->orderBy('delay','asc')
                ->orderBy('id','asc')
                ->first();
        }
        return $layer;
    }

    /**
     * 获取一条图文记录
     */
    public function getOneCon($productid,$layerid,$con_id)
    {
        if ($con_id==0) {
            $data = ProductConModel::where('productid',$productid)
                ->where('layerid',$layerid)
                ->orderBy('id','asc')
                ->first();
        } else {
            $data = ProductConModel::find($con_id);
        }
        return $data;
    }

    /**
     * 获取一条属性
     */
    public function getOneAttr($productid,$layerid,$genre)
    {
        $attr = ProductAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->where('genre',$genre)
            ->first();
        return $attr;
    }

    /**
     * 获取一个属性组合
     */
    public function getOneAttrs($productid,$layerid)
    {
        return ProductAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->get();
    }

    /**
     * 初始化一条内容
     */
    public function initCon($productid,$layerid)
    {
        $data = [
            'productid'=> $productid,
            'layerid'=> $layerid,
            'genre'=> 1,
            'pic_id'=> 1,
            'name'=> '',
            'created_at'=> time(),
        ];
        ProductConModel::create($data);
        $conModel = ProductConModel::where($data)->first();
        return $conModel;
    }

    /**
     * 初始化属性
     */
    public function initAttr($productid,$layerid)
    {
        $data = [
            'name'=> '',
            'style_name'=> $this->prefix_attr.$productid.'_'.rand(0,10000),
            'productid'=> $productid,
            'layerid'=> $layerid,
            'padding'=> '',
            'size'=> '720,405',
            'pos'=> '0,,',
            'float'=> 0,
            'opacity'=> '0,0',
            'border'=> '0,,1,1',
            'created_at'=> time(),
        ];
        $data1 = $data; $data2 = $data; $data3 = $data;
        $data1['genre'] = 1;
        $data2['genre'] = 2;
        $data3['genre'] = 3;
        ProductAttrModel::create($data1);
        ProductAttrModel::create($data2);
        ProductAttrModel::create($data3);
    }
}