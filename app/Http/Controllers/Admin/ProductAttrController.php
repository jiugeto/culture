<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductLayerModel;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * 系统后台内部产品属性管理
     */

    protected $prefix_attr = 'attr_';    //样式名称前缀

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '产品属性列表';
        $this->crumb['category']['name'] = '产品属性';
        $this->crumb['category']['url'] = 'proAttr';
        $this->model = new ProductAttrModel();
    }

    public function index($productid,$layerid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($productid,$layerid),
            'prefix_url'=> DOMAIN.'admin/'.$productid.'/'.$layerid.'/proAttr',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proAttr.index', $result);
    }

    public function create($productid,$layerid)
    {
        $attrModels = $this->getAttrs($productid,$layerid);
        if (count($attrModels)) {
            $attrName = $attrModels[0]->name;
        } elseif (count($attrModels)==3) {
            echo "<script>alert('该动画设置的属性样式已到上限！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
            'layerName'=> $this->getLayerNameById($layerid),
            'attrName'=> isset($attrName) ? $attrName : '',
        ];
       return view('admin.proAttr.create', $result);
    }

    public function store(Request $request,$productid,$layerid)
    {
        $data = $this->getData($request,$productid,$layerid);
        //类样式名称相同自动添加：属性前缀+用户id_+产品id_+随机值
        $data['style_name'] = $this->prefix_attr.$productid.'_'.rand(0,1000);
        //处理属性样式名称
        $attrModels = $this->getAttrs($productid,$layerid);
        if (count($attrModels) && !$request->name) {
            $data['name'] = $attrModels[0]->name;
        } elseif (!count($attrModels) && $request->name) {
            $data['name'] = $request->name;
        }
        $data['genre'] = $this->getGenre($productid,$layerid);
        $data['created_at'] = time();
        ProductAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proAttr');
    }

    public function edit($productid,$layerid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductAttrModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
            'layerName'=> $this->getLayerNameById($layerid),
        ];
        return view('admin.proAttr.edit', $result);
    }

    public function update(Request $request,$productid,$layerid,$id)
    {
        $data = $this->getData($request,$productid,$layerid,$id);
        $data['updated_at'] = time();
        ProductAttrModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proAttr');
    }

    public function show($productid,$id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductAttrModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
        return view('admin.proAttr.show', $result);
    }






    /**
     * 查询方法
     */
    public function query($productid,$layerid)
    {
        $datas = ProductAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->orderBy('id','asc')
            ->get();
//            ->paginate($this->limit);
//        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 数据收集
     */
    public function getData(Request $request,$productid,$layerid,$id=null)
    {
        //名称处理
        if ($id) {
            $attrModel = ProductAttrModel::find($id);
            $name = $attrModel->name;
        } else {
            $name = $request->name;
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
        //处理透明度
        if ($request->isopacity && $request->opacity=='') {
            echo "<script>alert('透明度不能空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $name,
            'productid'=> $productid,
            'layerid'=> $layerid,
            'padding'=> $padding,
            'size'=> $request->width.','.$request->height,
            'pos'=> $request->posType.','.$request->left.','.$request->top,
            'float'=> $request->float,
            'opacity'=> $request->isopacity.','.$request->opacity,
        ];
        return $data;
    }

    /**
     * 获得genre
     */
    public function getGenre($productid,$layerid)
    {
        $attrs = ProductAttrModel::where('productid',$productid)->where('layerid',$layerid)->get();
        if (!count($attrs)) {
            $genre = 1;     //开始层
        } elseif (count($attrs)==1) {
            $genre = 2;     //定位层
        } elseif (count($attrs)==2) {
            $genre = 3;     //动画层
        }
        return isset($genre) ? $genre : '';
    }

    /**
     * 通过 layerid 得到 layerName
     */
    public function getLayerNameById($layerid)
    {
        $layerModel = ProductLayerModel::find($layerid);
        return $layerModel ? $layerModel->name : '';
    }

    /**
     * 查看有没样式记录，有则获取样式名称
     */
    public function getAttrs($productid,$layerid)
    {
        return ProductAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->orderBy('genre','asc')
            ->get();
    }
}