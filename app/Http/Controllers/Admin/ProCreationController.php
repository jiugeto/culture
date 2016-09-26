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
            'layerModel'=> $this->layerModel,
            'cons'=> $this->getCons($productid,$layer->id),
            'content'=> $this->getOneCon($productid,$layer->id,$con_id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'attrModel'=> $this->attrModel,
//            'layerAttrs'=> $this->getLayerAttrs($productid,$layerid),
            'layerAttrModel'=> $this->layerAttrModel,
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
     * 添加动画设置
     */
    public function insertLayer(Request $request,$productid)
    {
        dd($productid,$request->all());
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$request->layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 添加动画关键帧
     */
    public function insertLayerAttr($productid,$layerid,$con_id,$genre,$attrSel,$per,$val)
    {
        if (!$productid || !$layerid || !$con_id || !$genre || !$attrSel || $per=='' || $val=='') {
            echo "<script>alert('参数不对！');history.go(-1);</script>";exit;
        }
//        dd($per,$layerid,$con_id,$attrSel,$genre,$per,$val);
        $data = [
            'productid'=> $productid,
            'layerid'=> $layerid,
            'attrSel'=> $attrSel,
            'per'=> $per,
            'val'=> $val,
            'created_at'=> time(),
        ];
        ProductLayerAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$layerid.'/'.$con_id.'/'.$genre);
    }

    /**
     * 新内容添加
     */
    public function insertCon(Request $request,$productid)
    {
        //一些限制
        if ($request->conGenre==1 && !$request->conPic) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->conGenre==2 && !$request->conText) {
            echo "<script>alert('文字必填！');history.go(-1);</script>";exit;
        }
        $data = [
            'productid'=> $productid,
            'layerid'=> $request->layerid,
            'genre'=> $request->conGenre,
            'pic_id'=> $request->conPic,
            'name'=> $request->conText,
            'created_at'=> time(),
        ];
        ProductConModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$request->layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 动画设置修改，这里id是layerid
     */
    public function updateLayer(Request $request,$productid,$id)
    {
        if ($request->delay=='' || $request->timelong=='') {
            echo "<script>alert('延时或者时长必填！');history.go(-1);</script>";exit;
        }
        if ($request->timelong==0) {
            echo "<script>alert('时长不能为0！');history.go(-1);</script>";exit;
        }
        $data = [
            'delay'=> $request->delay,
            'timelong'=> $request->timelong,
            'func'=> $request->func,
            'updated_at'=> time(),
        ];
        ProductLayerModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$request->layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 动画设置修改，这里id是layerAttrid
     */
    public function updateLayerAttr($productid,$layerid,$con_id,$genre,$layerAttrId,$attrSel,$per,$val)
    {
        if (!$productid || !$layerid || !$con_id || !$genre || !$layerAttrId || !$attrSel || $per=='' || $val=='') {
            echo "<script>alert('参数有误！');history.go(-1);</script>";exit;
        }
        $data = [
            'attrSel'=> $attrSel,
            'per'=> $per,
            'val'=> $val,
            'updated_at'=> time(),
        ];
        ProductLayerAttrModel::where('id',$layerAttrId)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$layerid.'/'.$con_id.'/'.$genre);
    }

    /**
     * 内容修改，这里id是con_id
     */
    public function updateCon(Request $request,$productid,$id)
    {
        if ($request->conGenre==1 && !$request->conPic) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->conGenre==2 && !$request->conText) {
            echo "<script>alert('文字必填！');history.go(-1);</script>";exit;
        }
        $data = [
            'genre'=> $request->conGenre,
            'pic_id'=> $request->conPic,
            'name'=> $request->conText,
            'updated_at'=> time(),
        ];
        ProductConModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$request->layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 属性修改，这里id是attrid
     */
    public function updateAttr(Request $request,$productid,$id)
    {
        //处理名称
        if ($request->genre==1) {
            $attrName = $request->name;
        } else {
            $attrModel = ProductAttrModel::find($id);
            $attrName= $attrModel->name;
        }
        //内边距处理
        if (!$request->padType) {
            $padding = '';
        } elseif ($request->padType==1) {
            if (!$request->pad1)  { echo "<script>alert('边距必填！');history.go(-1);</script>";exit; }
            $padding = $request->pad1;
        } elseif ($request->padType==2) {
            if ($request->pad2=='' || $request->pad3=='')  {
                echo "<script>alert('边距必填！');history.go(-1);</script>";exit;
            }
            $padding = $request->pad2.','.$request->pad3;
        } elseif ($request->padType==3) {
            if ($request->pad4=='' || $request->pad5=='' || $request->pad6=='' || $request->pad7=='')  {
                echo "<script>alert('边距必填！');history.go(-1);</script>";exit;
            }
            $padding = $request->pad4.','.$request->pad5.','.$request->pad6.','.$request->pad7;
        }
        $data = [
            'name'=> $attrName,
            'size'=> $request->width.','.$request->height,
            'padding'=> $padding,
            'border'=> $request->isborder.','.$request->borderWidth.','.$request->borderType.','.$request->borderColor,
            'pos'=> $request->posType.','.$request->left.','.$request->top,
            'float'=> $request->float,
            'opacity'=> $request->isopacity.','.$request->opacity,
            'updated_at'=> time(),
        ];
        ProductAttrModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/creation/edit/'.$request->layerid.'/'.$request->con_id.'/'.$request->genre);
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
            'layerAttrs'=> $this->getLayerAttrs($productid,$layerid),
            'layerAttrModel'=> $this->layerAttrModel,
            'cons'=> $this->getCons($productid,$layer->id),
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
            'layerAttrs'=> $this->getLayerAttrs($productid,$layerid),
            'layerAttrModel'=> $this->layerAttrModel,
            'cons'=> $this->getCons($productid,$layer->id),
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
    public function getAttrs($productid,$layerid)
    {
        return ProductAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->get();
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
    public function getLayerAttrs($productid,$layerid)
    {
        return ProductLayerAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->get();
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