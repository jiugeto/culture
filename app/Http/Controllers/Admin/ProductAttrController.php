<?php
namespace App\Http\Controllers\Admin;

use App\Models\ProductAttrModel;
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
        $this->crumb['']['name'] = '动画属性列表';
        $this->crumb['category']['name'] = '动画属性';
        $this->crumb['category']['url'] = 'productattr';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/productattr',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/admin/productattr/trash',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.productAttr.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ProductAttrModel::create($data);
        return redirect('/admin/productattr');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $this->getOne($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ProductAttrModel::where('id',$id)->update($data);
        return redirect('/admin/productattr');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $this->getOne($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.show', $result);
    }

    public function destroy($id)
    {
        ProductAttrModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/productattr');
    }

    public function restore($id)
    {
        ProductAttrModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/admin/productattr/trash');
    }

    public function forceDelete($id)
    {
        ProductAttrModel::where('id',$id)->delete();
        return redirect('/admin/productattr/trash');
    }





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $request->name = $this->prefix_attr.$request->name;     //加个前缀好区分
        //外边距
        if (!$request->margin1) { $request->margin1 = 'auto'; }
        if (!$request->margin2) { $request->margin2 = 'auto'; }
        $margin = $request->margin1.'-'.$request->margin2;
        //内边距
        if (!$request->padding1) { $request->padding1 = 'auto'; }
        if (!$request->padding2) { $request->padding2 = 'auto'; }
        $padding = $request->padding1.'-'.$request->padding2;
        //边框
        if ($request->border1) {
            if (!$request->border2 || !$request->border3 || !$request->border4) {
                echo "<script>alert('边框宽度、类型、颜色必填！');history.go(-1);</script>";exit;
            }
            $border = $request->border1.'-'.$request->border2.'-'.$request->border3.'-'.$request->border4;
        }
        //字的颜色
        if (!$request->color) { $request->color = ''; }
        $productAttr = [
            'name'=> $request->name,
            'style_name'=> $request->style_name,
            'productid'=> $request->productid,
            'margin'=> isset($margin) ? $margin : '',
            'padding'=> isset($padding) ? $padding : '',
            'width'=> $request->width,
            'height'=> $request->height,
            'border'=> isset($border) ? $border : '',
            'color'=> $request->color,
            'font_size'=> $request->font_size,
            'word_spacing'=> $request->word_spacing,
            'line_height'=> $request->line_height,
            'text_transform'=> $request->text_transform,
            'text_align'=> $request->text_align,
            'background'=> $request->background,
            'position'=> $request->position,
            'left'=> $request->left,
            'top'=> $request->top,
            'overflow'=> $request->overflow,
            'opacity'=> $request->opacity,
            'intro'=> $request->intro,
        ];
        return $productAttr;
    }

    /**
     * 查询方法
     */
    public function query($del)
    {
        return ProductAttrModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }

    /**
     * 查询一条数据
     */
    public function getOne($id)
    {
        $data = ProductAttrModel::find($id);
        if ($data->margin) {
            $margins = explode('-',$data->margin);
            $data->margin1 = $margins[0]=='auto'?'':$margins[0];
            $data->margin2 = $margins[1]=='auto'?'':$margins[1];
        } else {
            $data->margin1 = 0;
            $data->margin2 = 0;
        }
        if ($data->padding) {
            $paddings = explode('-',$data->padding);
            $data->padding1 = $paddings[0]=='auto'?'':$paddings[0];
            $data->padding2 = $paddings[1]=='auto'?'':$paddings[1];
        } else {
            $data->padding1 = 0;
            $data->padding2 = 0;
        }
        if ($data->border) {
            $borders = explode('-',$data->border);
            $data->border1 = $borders[0];
            $data->border2 = $borders[1];
            $data->border3 = $borders[2];
            $data->border4 = $borders[3];
        } else {
            $data->border1 = '';
            $data->border2 = 0;
            $data->border3 = 0;
            $data->border4 = '';
        }
        return $data;
    }
}