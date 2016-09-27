<?php
namespace App\Http\Controllers\Online;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use App\Models\Online\ProductLayerAttrModel;
use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 在线创作用户编辑
     */

    protected $limit = 12;
    protected $prefix_attr = 'attr_';

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function index($cate=0)
    {
        $result = [
            'datas'=> $this->query($cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'online/u/product',
            'cate'=> $cate,
        ];
        return view('online.home.index', $result);
    }

    public function getPro($id)
    {
        $productModel = ProductModel::find($id);
        if ($productModel->uid==$this->userid) {
            echo "<script>alert('自己的创作，不能获取！');history.go(-1);</script>";exit;
        }
        $productModel2 = ProductModel::where('uid',$this->userid)->where('serial',$productModel->serial)->first();
        if ($productModel2) {
            echo "<script>alert('已获取过此创作，不能重复获取！');history.go(-1);</script>";exit;
        }
        //复制product记录
        $productNewId = $this->getProduct($id);
        //复制layer记录
        $layerArr = $this->getLayer($id,$productNewId);
        //复制attr记录
        $attrNewIds = $this->getAttr($id,$productNewId,$layerArr);
        //复制con记录
        $conNewIds = $this->getCon($id,$productNewId,$layerArr);
        //复制layerattr记录
        $layerAttrNewIds = $this->getLayerAttrs($id,$productNewId,$layerArr);
        dd($id);
    }

//    public function show($id)
//    {
//        $result = [
//            'data'=> ProductModel::find($id),
//        ];
//        return view('online.home.show', $result);
//    }




    /**
     * 以下是要展示的数据
     */
    public function query($cate)
    {
        if ($cate) {
            $datas = ProductModel::where('cate',$cate)
                ->where('uid',$this->userid)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ProductModel::where('isshow',1)
                ->where('uid',$this->userid)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 获取产品记录
     */
    public function getProduct($id)
    {
        $productModel = ProductModel::find($id);
        $data = [
            'name'=> $productModel->name,
            'serial'=> date('YmdHis',time()).rand(0,10000),
            'cate'=> $productModel->cate,
            'gif'=> $productModel->gif,
            'intro'=> $productModel->intrp,
            'uid'=> $this->userid,
            'pid'=> $id,
            'created_at'=> time(),
        ];
        ProductModel::create($data);
        $productModelNew = ProductModel::where($data)->first();
        return $productModelNew->id;
    }

    /**
     * 获取动画设置记录
     * 产品id、产品新id
     * 得到新动画设置id数组
     */
    public function getLayer($pid,$newpid)
    {
        $layerModels = ProductLayerModel::where('productid',$pid)->get();
        $layerOldArr = array();
        $layerNewArr = array();
        foreach ($layerModels as $layerModel) {
            $data = [
                'name'=> $layerModel->name,
                'productid'=> $newpid,
                'a_name'=> $layerModel->a_name,
                'timelong'=> $layerModel->timelong,
                'func'=> $layerModel->func,
                'delay'=> $layerModel->delay,
                'created_at'=> time(),
            ];
            ProductLayerModel::create($data);
            $layerModelNew = ProductLayerModel::where($data)->first();
            $layerOldArr[] = $layerModel->id;
            $layerNewArr[] = $layerModelNew->id;
        }
        return array(
            'layerOld'=> $layerOldArr,
            'layerNew'=> $layerNewArr,
        );
    }

    /**
     * 获取属性样式记录
     * 产品id、新产品id、动画设置老新id
     * 得到新属性样式id数组
     */
    public function getAttr($pid,$newpid,$layerArr)
    {
        foreach ($layerArr['layerOld'] as $key=>$layerOld) {
            $this->getAttrData($pid,$layerArr['layerOld'][$key],1,$newpid,$layerArr['layerNew'][$key]);
            $this->getAttrData($pid,$layerArr['layerOld'][$key],2,$newpid,$layerArr['layerNew'][$key]);
            $this->getAttrData($pid,$layerArr['layerOld'][$key],3,$newpid,$layerArr['layerNew'][$key]);
        }
    }

    /**
     * 收集属性数据
     */
    public function getAttrData($pid,$layerid,$genre,$newpid,$layerNewId)
    {
        $attrModel = ProductAttrModel::where('productid',$pid)
            ->where('layerid',$layerid)
            ->where('genre',$genre)
            ->first();
        $data = [
            'name'=> $attrModel->name,
            'style_name'=> $this->prefix_attr.$layerNewId.rand(0,10000),
            'productid'=> $newpid,
            'layerid'=> $layerNewId,
            'genre'=> $genre,
            'padding'=> $attrModel->padding,
            'size'=> $attrModel->size,
            'pos'=> $attrModel->pos,
            'float'=> $attrModel->float,
            'opacity'=> $attrModel->opacity,
            'border'=> $attrModel->border,
            'created_at'=> time(),
        ];
        ProductAttrModel::create($data);
    }

    /**
     * 获取动画内容记录
     */
    public function getCon($pid,$newpid,$layerArr)
    {
        foreach ($layerArr['layerOld'] as $key=>$layerOld) {
            $this->getConData($pid,$layerArr['layerOld'][$key],$newpid,$layerArr['layerNew'][$key]);
        }
    }

    /**
     * 收集内容数据
     */
    public function getConData($pid,$layerid,$newpid,$layerNewId)
    {
        $conModel = ProductConModel::where('productid',$pid)
            ->where('layerid',$layerid)
            ->first();
        $data = [
            'productid'=> $newpid,
            'layerid'=> $layerNewId,
            'genre'=> $conModel->genre,
            'pic_id'=> $conModel->pic_id,
            'name'=> $conModel->name,
            'created_at'=> time(),
        ];
        ProductConModel::create($data);
    }

    /**
     * 获取动画关键帧记录
     */
    public function getLayerAttr($pid,$newpid,$layerArr)
    {
        foreach ($layerArr['layerOld'] as $key=>$layerOld) {
            $layerAttrs = ProductLayerAttrModel::where('productid',$pid)->where('layerid',$layerOld)->get();
            if (count($layerAttrs)) {
                foreach ($layerAttrs as $layerAttr) {
                    $data = [
                        'productid'=> $newpid,
                        'layerid'=> $layerArr['layerNew'][$key],
                        'attrSel'=> $layerAttr->attrSel,
                        'per'=> $layerAttr->per,
                        'val'=> $layerAttr->val,
                        'created_at'=> time(),
                    ];
                    ProductLayerAttrModel::create($data);
                }
            }
        }
    }
}