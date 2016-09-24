<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\PicModel;
use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use App\Models\Online\ProductLayerAttrModel;
use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class ProCreationController extends BaseController
{
    /**
     * 系统后台实时创作窗口
     */

    protected $prefix_url = 'attr_';
    protected $attrModel;
    protected $layerModel;
    protected $layerAttrModel;

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '实时创作';
        $this->crumb['category']['name'] = '产品管理';
        $this->crumb['category']['url'] = 'product';
        $this->model = new ProductModel();
        $this->attrModel = new ProductAttrModel();
        $this->layerModel = new ProductLayerModel();
        $this->layerAttrModel = new ProductLayerAttrModel();
    }

    public function index($productid,$layerid=0,$con_id=0,$genre=1)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'product'=> ProductModel::find($productid),
            'layers'=> $this->getLayers($productid),
            'layer'=> $layer,
//            'layerModel'=> $this->layerModel,
//            'layerAttrModel'=> $this->layerAttrModel,
            'cons'=> $this->getCons($productid,$layer->id),
            'content'=> $this->getOneCon($productid,$layer->id,$con_id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'attrModel'=> $this->attrModel,
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'currUrl'=> 'play',
            'layerid'=> $layer->id,
            'con_id'=> $con_id,
            'attrGenre'=> $genre,
        ];
        return view('admin.proCreation.index', $result);
    }

    /**
     * 总编辑窗口
     */
    public function edit($productid,$layerid=0,$con_id=0,$genre=1)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'product'=> ProductModel::find($productid),
            'layers'=> $this->getLayers($productid),
            'layer'=> $layer,
//            'layerModel'=> $this->layerModel,
//            'layerAttrModel'=> $this->layerAttrModel,
            'cons'=> $this->getCons($productid,$layer->id),
            'content'=> $this->getOneCon($productid,$layer->id,$con_id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'attrModel'=> $this->attrModel,
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'currUrl'=> 'edit',
            'layerid'=> $layer->id,
            'con_id'=> $con_id,
            'attrGenre'=> $genre,
        ];
        return view('admin.proCreation.index', $result);
    }

    /**
     * 新内容添加
     */
    public function insertCon(Request $request,$productid)
    {
        //一些限制
        if ($request->genre==1 && !$request->pic) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->genre==2 && !$request->text) {
            echo "<script>alert('文字必填！');history.go(-1);</script>";exit;
        }
        dd('000');

        //添加一个默认属性样式记录
        $attr = [
            'name'=> '',
            'style_name'=> $this->prefix_url.$productid.'_'.rand(0,1000),
            'genre'=> 1,        //图层默认第一层
            'padding'=> '',     //边框默认无
            'size'=> '100,100',     //默认宽高100*100
            'pos'=> '0,,',      //定位默认无
            'float'=> 0,        //浮动默认无
            'opacity'=> '0,0',      //默认无
            'created_at'=> time(),
        ];
        ProductAttrModel::create($attr);

        //增加内容记录
        $attrModel = ProductAttrModel::where($attr)->first();
        $data = [
            'productid'=> $request->productid,
            'attrid'=> $attrModel->id,
            'genre'=> $request->genre,
            'pic_id'=> $request->pic,
            'name'=> $request->text,
            'created_at'=> time(),
        ];
        ProductConModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/editCon');
    }

    /**
     * 内容修改，这里id是con_id
     */
    public function updateCon(Request $request,$productid,$id)
    {
        dd('111',$request->all());
    }






    /**
     * 动画预览
     */
    public function play($productid,$layerid,$con_id,$genre)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'currUrl'=> $urls[count($urls)-1],
            'layer'=> $layer,
            'attrs'=> $this->getOneAttrs($productid,$layer->id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'layerAttrs'=> $this->getLayerAttrs($layerid),
            'layerAttrModel'=> $this->layerAttrModel,
        ];
        return view('admin.proCreation.basic.play', $result);
    }

    /**
     * 动画编辑
     */
    public function play2($productid,$layerid,$con_id,$genre)
    {
        $urls = explode('/',$_SERVER['REQUEST_URI']);
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'currUrl'=> $urls[count($urls)-1],
            'layer'=> $layer,
            'attrs'=> $this->getOneAttrs($productid,$layer->id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'layerAttrs'=> $this->getLayerAttrs($layerid),
            'layerAttrModel'=> $this->layerAttrModel,
        ];
        return view('admin.proCreation.basic.edit', $result);
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
    public function getAttrs($productid)
    {
        return ProductAttrModel::where('productid',$productid)->get();
    }

    /**
     * 获取图文内容
     */
    public function getCons($productid,$layerid)
    {
        return ProductConModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->orderBy('id','desc')
            ->get();
    }

    /**
     * 获取动画关键帧
     */
    public function getLayerAttrs($layerid)
    {
        return ProductLayerAttrModel::where('layerid',$layerid)->get();
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
}