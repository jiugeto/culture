<?php
namespace App\Http\Controllers\Online;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use App\Models\Online\ProductLayerAttrModel;
use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Ajax;
use Illuminate\Support\Facades\Input;

class FrameController extends BaseController
{
    /**
     * 在线创作 单帧管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function index($productid,$layerid=0,$con_id=0,$genre=1)
    {
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'product'=> ProductModel::find($productid),
            'cons'=> $this->getCons($productid,$layer->id),
            'content'=> $this->getOneCon($productid,$layer->id,$con_id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'attrModel'=> $this->attrModel,
            'layers'=> $this->getLayers($productid),
            'layer'=> $layer,
            'layerModel'=> $this->layerModel,
            'pics'=> $this->model->getUserPics($this->userid),
            'layerid'=> $layer->id,
            'con_id'=> $con_id,
            'genre'=> $genre,
        ];
        return view('online.frame.index', $result);
    }






    /**
     * 动画设置添加
     */
    public function insertLayer(Request $request,$productid)
    {
        if (!$request->layerName || !$request->timelong) {
            echo "<script>alert('动画设置名称、时长、延时必填！');history.go(-1);</script>";exit;
        }
        if (strlen($request->layerName)<2 || strlen($request->layerName)>20) {
            echo "<script>alert('动画设置名称2-20个字符之间！');history.go(-1);</script>";exit;
        }
        if (!$request->delay=='') {
            echo "<script>alert('动画延时必填！');history.go(-1);</script>";exit;
        }

        $record = [
            'timelong'=> 0,
            'delay'=> 0,
            'func'=> 0,
        ];
        $data = [
            'name'=> $request->layerName,
            'productid'=> $productid,
            'a_name'=> $this->prefix_layer.$productid.'_'.rand(0,10000),
            'timelong'=> $request->timelong,
            'delay'=> $request->delay,
            'func'=> $request->func,
            'created_at'=> time(),
            'record'=> serialize($record),
            'is_add'=> 1,       //用户首次添加
        ];
        ProductLayerModel::create($data);
        $layerModel = ProductLayerModel::where($data)->first();
        //初始化内容
        $conModel = $this->initCon($productid,$layerModel->id);
        //初始化属性1，2,3
        $attrModel = $this->initAttr($productid,$layerModel->id);
        return redirect(DOMAIN.'online/u/'.$productid.'/frame/'.$layerModel->id.'/'.$conModel->id.'/1');
    }

    /**
     * 内容添加
     */
    public function insertCon(Request $request,$productid)
    {
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
            'record'=> 0,
            'is_add'=> 1,
        ];
        ProductConModel::create($data);
        $conModel = ProductConModel::where($data)->first();
        return redirect(DOMAIN.'online/u/'.$productid.'/frame/'.$request->layerid.'/'.$conModel->id.'/1');
    }

    /**
     * 关键帧添加
     */
    public function insertLayerAttr()
    {
        if (Ajax::ajax()) {
            $data = Input::all();
            if (!$data['productid'] || !$data['layerid'] || !$data['con_id'] || !$data['genre'] || !$data['attrSel'] || !$data['per'] || !$data['val']) {
                echo json_encode(array('code'=>'-1', 'message' =>'参数有误！'));exit;
            }
            $data = [
                'productid'=> $data['productid'],
                'layerid'=> $data['layerid'],
                'attrSel'=> $data['layerAttr'],
                'per'=> $data['per'],
                'val'=> $data['val'],
                'record'=> 0,
                'is_add'=> 1,
            ];
            ProductLayerAttrModel::create($data);
            echo json_encode(array('code'=>'0', 'message' =>'操作成功！'));exit;
        }
        echo json_encode(array('code'=>'-2', 'message' =>'操作失败！'));exit;
    }

    /**
     * 动画设置修改
     */
    public function updateLayer(Request $request,$productid,$layerid)
    {
        if ($request->delay=='' || !$request->timelong) {
            echo "<script>alert('动画设置的延时、时长必填！');history.go(-1);</script>";exit;
        }
        //判断已经修改的字段
        $record = [
            'delay'=> 0,
            'timelong'=> 0,
            'func'=> 0,
        ];
        $data = [
            'delay'=> $request->delay,
            'timelong'=> $request->timelong,
            'func'=> $request->func,
            'updated_at'=> time(),
            'record'=> serialize($record),
        ];
        ProductLayerModel::where('id',$layerid)->update($data);

        //判断是否用户自己添加的设置
        $layerModel = ProductLayerModel::find($layerid);
        $record2 = $record;
        if ($request->delay!=$layerModel->delay) { $record2['delay'] = 1; }
        if ($request->timelong!=$layerModel->timelong) { $record2['timelong'] = 1; }
        if ($request->func!=$layerModel->func) { $record2['func'] = 1; }
        if (isset($record2)) {
            ProductLayerModel::where('id',$layerid)
                ->where('record',serialize($record))
                ->update(['record'=> serialize($record2),'is_add'=> 2]);
        }

        return redirect(DOMAIN.'online/u/'.$productid.'/frame/'.$layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 内容修改
     */
    public function updateCon(Request $request,$productid,$con_id)
    {
        if ($request->conGenre==1 && !$request->conPic) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        } elseif ($request->conGenre==2 && !$request->conText) {
            echo "<script>alert('文字必填！');history.go(-1);</script>";exit;
        }
        $data = [
            'genre'=> $request->conGenre,
            'pic_id'=> $request->conPic,
            'name'=> $request->conText,
            'updated_at'=> time(),
//            'record'=> 0,
//            'is_add'=> 1,
        ];
        ProductConModel::where('id',$con_id)->update($data);

        //判断有无更新，判断是否用户自己添加的再更新
        $conModel = ProductConModel::find($con_id);
        if ($con_id->genre==$request->conGenre || $con_id->pic_id==$request->conPic || $con_id->name==$request->conText) {
            $isadd = $conModel->is_add==1 ? 2 : $conModel->is_add;
            ProductConModel::where('id',$con_id)->update(['record'=> 1,'is_add'=> $isadd]);
        }

        return redirect(DOMAIN.'online/u/'.$productid.'/frame/'.$request->layerid.'/'.$con_id.'/'.$request->attrGenre);
    }

    /**
     * 属性样式修改
     */
    public function updateAttr(Request $request,$productid,$attrid)
    {
        //样式名称
        $attrModel = ProductAttrModel::find($attrid);
        if ($request->genre==1 && !$request->name) {
            echo "<script>alert('样式名称必填！');history.go(-1);</script>";exit;
        } elseif ($request->genre!=1) {
            $request->name = $attrModel->name;
        }
        //宽高
        if (!$request->width || !$request->height) {
            echo "<script>alert('宽高必填！');history.go(-1);</script>";exit;
        }
        $size = $request->width.','.$request->height;
        //内边距
        if ($request->padType==0) {
            $padding = '';
        } elseif ($request->padType==1) {
            $padding = $request->pad1;
        } elseif ($request->padType==2) {
            $padding = $request->pad2.','.$request->pad3;
        } elseif ($request->padType==3) {
            $padding = $request->pad4.','.$request->pad5.','.$request->pad6.','.$request->pad7;
        }
        //边框
        if ($request->isborder==0) {
            $border = '0,,1,1';
        } else {
            if (!$request->borderText) { echo "<script>alert('边框宽度必填！');history.go(-1);</script>";exit; }
            $border = '1,'.$request->borderText.','.$request->borderType.','.$request->borderColor;
        }
        //定位方式
        if ($request->posType && !$request->left && !$request->top) {
            echo "<script>alert('宽高未填！');history.go(-1);</script>";exit;
        }
        $pos = $request->posType.','.$request->left.','.$request->top;
        //透明度
        if ($request->isopacity && $request->opacity=='') {
            echo "<script>alert('透明度必填！');history.go(-1);</script>";exit;
        }
        $opacity = $request->isopacity.','.$request->opacity;
        //判断更新数据
        $record['size'] = $attrModel->size==$size ? 1 : 0;
        $record['padding'] = $attrModel->padding==$padding ? 1 : 0;
        $record['border'] = $attrModel->border==$border ? 1 : 0;
        $record['pos'] = $attrModel->pos==$pos ? 1 : 0;
        $record['float'] = $attrModel->float;
        $record['opacity'] = $attrModel->opacity==$opacity ? 1 : 0;
        $data = [
            'name'=> $request->name,
            'size'=> $size,
            'padding'=> $padding,
            'border'=> $border,
            'pos'=> $pos,
            'float'=> $request->float,
            'opacity'=> $opacity,
            'updated_at'=> time(),
            'record'=> serialize($record),
        ];
        ProductAttrModel::where('id',$attrid)->update($data);
        return redirect(DOMAIN.'online/u/'.$productid.'/frame/'.$request->layerid.'/'.$request->con_id.'/'.$request->attrGenre);
    }

    /**
     * 关键帧修改
     */
    public function updateLayerAttr($productid,$layerAttrId)
    {
        if (Ajax::ajax()) {
            $data = Input::all();
            if (!$productid || !$data['layerid'] || !$data['con_id'] || !$data['genre'] || !$layerAttrId || !$data['attrSel'] || $data['per']=='' || $data['val']=='') {
                echo json_encode(array('code'=>'-1', 'message' =>'参数有误！'));exit;
            }
            $data = [
                'productid'=> $productid,
                'layerid'=> $data['layerid'],
                'attrSel'=> $data['attrSel'],
                'per'=> $data['per'],
                'val'=> $data['val'],
//                'record'=> 0,
//                'is_add'=> 1,
            ];
            ProductLayerAttrModel::where('id',$layerAttrId)->update($data);

            //判断关键帧是否修改
            $layerAttr = ProductLayerAttrModel::find($layerAttrId);
            if ($layerAttr->attrSel==$data['attrSel'] || $layerAttr->per==$data['per'] || $layerAttr->val==$data['val']) {
                $isadd = $layerAttr->is_add==1 ? 2 : $layerAttr->is_add;
                ProductLayerAttrModel::where('id',$layerAttrId)->update(['record'=> 1, 'is_add'=> $isadd]);
            }

            echo json_encode(array('code'=>'0', 'message' =>'操作成功！'));exit;
        }
        echo json_encode(array('code'=>'-2', 'message' =>'操作失败！'));exit;
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
            'name'=> '样式'.$layerid,
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