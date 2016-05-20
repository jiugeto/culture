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
        $this->crumb['']['name'] = '产品属性列表';
        $this->crumb['category']['name'] = '产品属性';
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
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $data,
            'attrs'=> $this->getAttrs($data),
            'textAttr'=> $this->getTextAttr($data),
            'picAttr'=> $this->getPicAttr($data),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
//        dd($this->getAttrs($data),$this->model['marginTypes']);
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
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $data,
            'attrs'=> $this->getAttrs($data),
            'textAttr'=> $this->getTextAttr($data),
            'picAttr'=> $this->getPicAttr($data),
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
        $productAttr = [
            'name'=> $request->name,
            'style_name'=> $this->prefix_attr.$request->style_name,     //加个前缀好区分
            'productid'=> $request->productid,
            'attrs'=> serialize($this->toAttrs($request)),
            'text'=> serialize($this->toTextAttr($request)),
            'img'=> serialize($this->toPicAttr($request)),
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
     * 总的样式属性处理
     */
    public function toAttrs($request)
    {
        //外边距：margin1上下，margin2左右，
        if ($request->ismargin==2) { $request->margin1 = 'auto'; $request->margin2 = 'auto'; }
        if ($request->ismargin==3) {
            $request->margin1 = 'auto';
            if ($request->margin2=='') { echo "<script>alert('左右外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ismargin==4) {
            $request->margin2 = 'auto';
            if ($request->margin1=='') { echo "<script>alert('上下外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ismargin==5) {
            if ($request->margin3=='' || $request->margin4=='' || $request->margin5=='' || $request->margin6=='') {
                echo "<script>alert('上下左右外边距必填！');history.go(-1);</script>";exit;
            }
        }
        //内边距margin1上下，margin2左右，
        if ($request->ispadding==2) { $request->padding1 = 'auto'; $request->padding2 = 'auto'; }
        if ($request->ispadding==3) {
            $request->padding1 = 'auto';
            if ($request->padding2=='') { echo "<script>alert('左右内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispadding==4) {
            $request->padding2 = 'auto';
            if ($request->padding1=='') { echo "<script>alert('上下内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispadding==5) {
            if ($request->padding3=='' || $request->padding4=='' || $request->padding5=='' || $request->padding6=='') {
                echo "<script>alert('上下左右内边距必填！');history.go(-1);</script>";exit;
            }
        }
        //边框
        if ($request->border1) {
            if (!$request->border2 || !$request->border3 || !$request->border4) {
                echo "<script>alert('边框宽度、类型、颜色必填！');history.go(-1);</script>";exit;
            }
        }
        //组合样式
        $attrs = [
            'switch0'=> $request->switch0,
            'ismargin'=> $request->ismargin,
            'margin1'=> $request->margin1,
            'margin2'=> $request->margin2,
            'margin3'=> $request->margin3,
            'margin4'=> $request->margin4,
            'margin5'=> $request->margin5,
            'margin6'=> $request->margin6,
            'ispadding'=> $request->ispadding,
            'padding1'=> $request->padding1,
            'padding2'=> $request->padding2,
            'padding3'=> $request->padding3,
            'padding4'=> $request->padding4,
            'padding5'=> $request->padding5,
            'padding6'=> $request->padding6,
            'width'=> $request->width,
            'height'=> $request->height,
            'border1'=> $request->border1,
            'border2'=> $request->border2,
            'border3'=> $request->border3,
            'border4'=> $request->border4,
            'color'=> $request->color,
            'font_size'=> $request->font_size,
            'word_spacing'=> $request->word_spacing,
            'line_height'=> $request->line_height,
            'text_transform'=> $request->text_transform,
            'text_align'=> $request->text_align,
            'background'=> $request->background,
            'position'=> $request->postion,
            'left'=> $request->left,
            'top'=> $request->top,
            'overflow'=> $request->overflow,
            'opacity'=> $request->opacity,
        ];
        return $attrs;
    }

    /**
     * 文字样式属性处理
     */
    public function toTextAttr($request)
    {
        //外边距：textmargin1上下，textmargin2左右，
        if ($request->istextmargin==2) { $request->textmargin1 = 'auto'; $request->textmargin2 = 'auto'; }
        if ($request->istextmargin==3) {
            $request->textmargin1 = 'auto';
            if ($request->textmargin2=='') { echo "<script>alert('左右外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->istextmargin==4) {
            $request->textmargin2 = 'auto';
            if ($request->textmargin1=='') { echo "<script>alert('上下外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->istextmargin==5) {
            if ($request->textmargin3=='' || $request->textmargin4=='' || $request->textmargin5=='' || $request->textmargin6=='') {
                echo "<script>alert('上下左右外边距必填！');history.go(-1);</script>";exit;
            }
        }
        //内边距textpadding1上下，textpadding2左右，
        if ($request->istextpadding==2) { $request->textpadding1 = 'auto'; $request->textpadding2 = 'auto'; }
        if ($request->istextpadding==3) {
            $request->textpadding1 = 'auto';
            if ($request->textpadding2=='') { echo "<script>alert('左右内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->istextpadding==4) {
            $request->textpadding2 = 'auto';
            if ($request->textpadding1=='') { echo "<script>alert('上下内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->istextpadding==5) {
            if ($request->textpadding3=='' || $request->textpadding4=='' || $request->textpadding5=='' || $request->textpadding6=='') {
                echo "<script>alert('上下左右内边距必填！');history.go(-1);</script>";exit;
            }
        }
        //边框
        if ($request->textborder1) {
            if (!$request->textborder2 || !$request->textborder3 || !$request->textborder4) {
                echo "<script>alert('边框宽度、类型、颜色必填！');history.go(-1);</script>";exit;
            }
        }
        $textAttr = [
            'switch1'=> $request->switch1,
            'istextmargin'=> $request->istextmargin,
            'textmargin1'=> $request->textmargin1,
            'textmargin2'=> $request->textmargin2,
            'textmargin3'=> $request->textmargin3,
            'textmargin4'=> $request->textmargin4,
            'textmargin5'=> $request->textmargin5,
            'textmargin6'=> $request->textmargin6,
            'istextpadding'=> $request->istextpadding,
            'textpadding1'=> $request->textpadding1,
            'textpadding2'=> $request->textpadding2,
            'textpadding3'=> $request->textpadding3,
            'textpadding4'=> $request->textpadding4,
            'textpadding5'=> $request->textpadding5,
            'textpadding6'=> $request->textpadding6,
            'textcolor'=> $request->textcolor,
            'font_size'=> $request->font_size,
            'word_spacing'=> $request->word_spacing,
            'line_height'=> $request->line_height,
            'text_transform'=> $request->text_transform,
            'text_align'=> $request->text_align,
            'background'=> $request->background,
        ];
        return $textAttr;
    }

    /**
     * 图片样式属性处理
     */
    public function toPicAttr($request)
    {
        //外边距：picmargin1上下，picmargin2左右，
        if ($request->ispicmargin==2) { $request->picmargin1 = 'auto'; $request->picmargin2 = 'auto'; }
        if ($request->ispicmargin==3) {
            $request->picmargin1 = 'auto';
            if ($request->picmargin2=='') { echo "<script>alert('左右外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispicmargin==4) {
            $request->picmargin2 = 'auto';
            if ($request->picmargin1=='') { echo "<script>alert('上下外边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispicmargin==5) {
            if ($request->picmargin3=='' || $request->picmargin4=='' || $request->picmargin5=='' || $request->picmargin6=='') {
                echo "<script>alert('上下左右外边距必填！');history.go(-1);</script>";exit;
            }
        }
        //内边距picpadding1上下，picpadding2左右，
        if ($request->ispicpadding==2) { $request->picpadding1 = 'auto'; $request->picpadding2 = 'auto'; }
        if ($request->ispicpadding==3) {
            $request->picpadding1 = 'auto';
            if ($request->picpadding2=='') { echo "<script>alert('左右内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispicpadding==4) {
            $request->picpadding2 = 'auto';
            if ($request->picpadding1=='') { echo "<script>alert('上下内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispicpadding==5) {
            if ($request->picpadding3=='' || $request->picpadding4=='' || $request->picpadding5=='' || $request->picpadding6=='') {
                echo "<script>alert('上下左右内边距必填！');history.go(-1);</script>";exit;
            }
        }
        //边框
        if ($request->picborder1) {
            if (!$request->picborder2 || !$request->picborder3 || !$request->picborder4) {
                echo "<script>alert('边框宽度、类型、颜色必填！');history.go(-1);</script>";exit;
            }
        }
        $picAttr = [
            'switch2'=> $request->switch2,
            'ispicmargin'=> $request->ispicmargin,
            'picmargin1'=> $request->picmargin1,
            'picmargin2'=> $request->picmargin2,
            'picmargin3'=> $request->picmargin3,
            'picmargin4'=> $request->picmargin4,
            'picmargin5'=> $request->picmargin5,
            'picmargin6'=> $request->picmargin6,
            'ispicpadding'=> $request->ispicpadding,
            'picpadding1'=> $request->picpadding1,
            'picpadding2'=> $request->picpadding2,
            'picpadding3'=> $request->picpadding3,
            'picpadding4'=> $request->picpadding4,
            'picpadding5'=> $request->picpadding5,
            'picpadding6'=> $request->picpadding6,
            'picborder1'=> $request->picborder1,
            'picborder2'=> $request->picborder2,
            'picborder3'=> $request->picborder3,
            'picborder4'=> $request->picborder4,
            'picwidth'=> $request->picwidth,
            'picheight'=> $request->picheight,
        ];
        return $picAttr;
    }

    /**
     * 初始化总的属性
     */
    public function getAttrs($data)
    {
        $attrs = $data->attrs ? unserialize($data->attrs) : [];
        if (!isset($attrs['switch0']) || !(isset($attrs['switch0']) && $attrs['switch0'])) {
            $attrs = [
                'switch0'=> 0,
                'ismargin'=> 1,
                'margin1'=> '',
                'margin2'=> '',
                'margin3'=> '',
                'margin4'=> '',
                'margin5'=> '',
                'margin6'=> '',
                'ispadding'=> 1,
                'padding1'=> '',
                'padding2'=> '',
                'padding3'=> '',
                'padding4'=> '',
                'padding5'=> '',
                'padding6'=> '',
                'width'=> '',
                'height'=> '',
                'border1'=> 0,
                'border2'=> '',
                'border3'=> '',
                'border4'=> '',
                'color'=> '',
                'font_size'=> '',
                'word_spacing'=> '',
                'line_height'=> '',
                'text_transform'=> '',
                'text_align'=> '',
                'background'=> '',
                'position'=> 0,
                'left'=> '',
                'top'=> '',
                'overflow'=> '',
                'opacity'=> '',
            ];
        }
        return $attrs;
    }

    /**
     * 初始化文字属性
     */
    public function getTextAttr($data)
    {
        $textAttr = $data->text ? unserialize($data->text) : [];
        if (!isset($textAttr['switch1']) || !(isset($textAttr['switch1']) && $textAttr['switch1'])) {
            $textAttr = [
                'switch1'=> 0,
                'istextmargin'=> 1,
                'textmargin1'=> '',
                'textmargin2'=> '',
                'textmargin3'=> '',
                'textmargin4'=> '',
                'textmargin5'=> '',
                'textmargin6'=> '',
                'istextpadding'=> 1,
                'textpadding1'=> '',
                'textpadding2'=> '',
                'textpadding3'=> '',
                'textpadding4'=> '',
                'textpadding5'=> '',
                'textpadding6'=> '',
                'textborder1'=> '',
                'textborder2'=> '',
                'textborder3'=> '',
                'textborder4'=> '',
                'text_font_size'=> '',
                'text_word_spacing'=> '',
                'text_line_height'=> '',
                'textcolor'=> '',
            ];
        }
        return $textAttr;
    }

    /**
     * 初始化文字属性
     */
    public function getPicAttr($data)
    {
        $picAttr = $data->img ? unserialize($data->img) : [];
        if (!isset($picAttr['switch2']) || !(isset($picAttr['switch2']) && $picAttr['switch2'])) {
            $picAttr = [
                'switch2'=> 0,
                'ispicmargin'=> 1,
                'picmargin1'=> '',
                'picmargin2'=> '',
                'picmargin3'=> '',
                'picmargin4'=> '',
                'picmargin5'=> '',
                'picmargin6'=> '',
                'ispicpadding'=> 1,
                'picpadding1'=> '',
                'picpadding2'=> '',
                'picpadding3'=> '',
                'picpadding4'=> '',
                'picpadding5'=> '',
                'picpadding6'=> '',
                'picborder1'=> '',
                'picborder2'=> '',
                'picborder3'=> '',
                'picborder4'=> '',
                'picwidth'=> '',
                'picheight'=> '',
            ];
        }
        return $picAttr;
    }
}