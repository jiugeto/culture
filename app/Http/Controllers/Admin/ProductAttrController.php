<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
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
        $this->model = new ProductAttrModel();
        $this->crumb['']['name'] = '产品属性列表';
        $this->crumb['category']['name'] = '产品属性';
        $this->crumb['category']['url'] = 'proAttr';
    }

    public function index($productid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($productid),
            'prefix_url'=> DOMAIN.'admin/'.$productid.'/proAttr',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
        return view('admin.proAttr.index', $result);
    }

    public function create($productid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
       return view('admin.proAttr.create', $result);
    }

    public function store(Request $request,$productid)
    {
        $data = $this->getData($request,$productid);
        //类样式名称相同自动添加：属性前缀+用户id_+产品id_+随机值
        $data['style_name'] = $this->prefix_attr.$productid.'_'.rand(0,1000);
        $data['name'] = $request->name;
        $data['genre'] = 1;         //1代表开始层
        $data['created_at'] = time();
        ProductAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    public function edit($productid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductAttrModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
        return view('admin.proAttr.edit', $result);
    }

    public function update(Request $request,$productid,$id)
    {
        $data = $this->getData($request,$productid);
        $data['name'] = $request->name;
        $data['updated_at'] = time();
        ProductAttrModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
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
     * 定位层添加
     */
    public function create2($productid,$id)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'parent'=> ProductAttrModel::find($id),
        ];
        return view('admin.proAttr.create2', $result);
    }

    /**
     * 定位层插入
     */
    public function store2(Request $request,$productid,$id)
    {
        $data = $this->getData($request,$productid);
        $attrModel = ProductAttrModel::find($id);
        $data['name'] = $attrModel->name;
        $data['style_name'] = $attrModel->style_name;
        $data['genre'] = 2;
        $data['parent'] = $id;
        $data['created_at'] = time();
        ProductAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    /**
     * 编辑定位层
     */
    public function edit2($productid,$id,$subid)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductAttrModel::find($subid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'parent'=> ProductAttrModel::find($id),
        ];
        return view('admin.proAttr.edit2', $result);
    }

    /**
     * 更新定位层
     */
    public function update2(Request $request,$productid,$id,$subid)
    {
        $data = $this->getData($request,$productid);
        $attrModel = ProductAttrModel::find($id);
        $data['name'] = $attrModel->name;
        $data['style_name'] = $attrModel->style_name;
        $data['genre'] = 2;
        $data['parent'] = $id;
        $data['updated_at'] = time();
        ProductAttrModel::where('id',$subid)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    /**
     * 动画层添加
     */
    public function create3($productid,$id)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'parent'=> ProductAttrModel::find($id),
        ];
        return view('admin.proAttr.create3', $result);
    }

    /**
     * 动画层插入
     */
    public function store3(Request $request,$productid,$id)
    {
        $data = $this->getData($request,$productid);
        $attrModel = ProductAttrModel::find($id);
        $data['name'] = $attrModel->name;
        $data['style_name'] = $attrModel->style_name;
        $data['genre'] = 3;
        $data['parent'] = $id;
        $data['created_at'] = time();
        ProductAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }

    /**
     * 编辑动画层
     */
    public function edit3($productid,$id,$subid)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductAttrModel::find($subid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'parent'=> ProductAttrModel::find($id),
        ];
        return view('admin.proAttr.edit3', $result);
    }

    /**
     * 更新动画层
     */
    public function update3(Request $request,$productid,$id,$subid)
    {
        $data = $this->getData($request,$productid);
        $attrModel = ProductAttrModel::find($id);
        $data['name'] = $attrModel->name;
        $data['style_name'] = $attrModel->style_name;
        $data['genre'] = 3;
        $data['parent'] = $id;
        $data['updated_at'] = time();
        ProductAttrModel::where('id',$subid)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proAttr');
    }






    /**
     * 数据收集
     */
    public function getData(Request $request,$productid)
    {
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
//            'name'=> $request->name,
            'productid'=> $productid,
            'padding'=> $padding,
            'size'=> $request->width.','.$request->height,
            'pos'=> $request->posType.','.$request->left.','.$request->top,
            'float'=> $request->float,
            'opacity'=> $request->isopacity.','.$request->opacity,
            'text'=> '',
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($productid)
    {
        $datas = ProductAttrModel::where('productid',$productid)
            ->where('parent',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}