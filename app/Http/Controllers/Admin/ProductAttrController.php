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
            'data'=> $this->getOne($data),
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

    /**
     * 图片编辑
     */
    public function editPic($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $this->getOnePic($data),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.editPic', $result);
    }

    /**
     * 图片更新
     */
    public function updatePic(Request $request,$id)
    {
        ProductAttrModel::where('id',$id)->update(['img'=> serialize($this->getPic($request))]);
        return redirect('/admin/productattr');
    }

    /**
     * 文字编辑
     */
    public function editText($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $this->getOneText($data),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.editText', $result);
    }

    /**
     * 文字更新
     */
    public function updateText(Request $request,$id)
    {
        ProductAttrModel::where('id',$id)->update(['text'=> serialize($this->getText($request))]);
        return redirect('/admin/productattr');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $this->getOne($data),
            'picInfo'=> $data->img ? unserialize($data->img) : $this->getOnePic($data),
            'textInfo'=> $data->text ? unserialize($data->text) : $this->getOneText($data),
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
        $request->style_name = $this->prefix_attr.$request->style_name;     //加个前缀好区分
        $attrs = $this->toAttrs($request);
        $productAttr = [
            'name'=> $request->name,
            'style_name'=> $request->style_name,
            'productid'=> $request->productid,
            'attrs'=> serialize($attrs),
//            'margin'=> isset($margin) ? $margin : '',
//            'padding'=> isset($padding) ? $padding : '',
//            'width'=> $request->width,
//            'height'=> $request->height,
//            'border'=> isset($border) ? $border : '',
//            'color'=> $request->color,
//            'font_size'=> $request->font_size,
//            'word_spacing'=> $request->word_spacing,
//            'line_height'=> $request->line_height,
//            'text_transform'=> $request->text_transform,
//            'text_align'=> $request->text_align,
//            'background'=> $request->background,
//            'position'=> $request->position,
//            'left'=> $request->left,
//            'top'=> $request->top,
//            'overflow'=> $request->overflow,
//            'opacity'=> $request->opacity,
            'intro'=> $request->intro,
        ];
        return $productAttr;
    }

    /**
     * 总的样式属性处理
     */
    public function toAttrs($request)
    {
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
        //组合样式
        $attrs = [
            'ismargin'=> '',
            'margin1'=> '',
            'margin2'=> '',
            'margin3'=> '',
            'margin4'=> '',
            'margin5'=> '',
            'margin6'=> '',
            'ispadding'=> '',
            'ispadding2'=> '',
            'ispadding1'=> '',
            'ispadding3'=> '',
            'ispadding4'=> '',
            'ispadding5'=> '',
            'ispadding6'=> '',
            'width'=> '',
            'height'=> '',
            'border1'=> '',
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
            'left'=> '',
            'top'=> '',
            'overflow'=> '',
            'opacity'=> '',
        ];
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
//    public function getOne($data)
//    {
//        $data->style_name = substr($data->style_name,5,strlen($data->style_name)-1);
//        if ($data->margin) {
//            $margins = explode('-',$data->margin);
//            $data->margin1 = $margins[0]=='auto'?'':$margins[0];
//            $data->margin2 = $margins[1]=='auto'?'':$margins[1];
//        } else {
//            $data->margin1 = 0;
//            $data->margin2 = 0;
//        }
//        if ($data->padding) {
//            $paddings = explode('-',$data->padding);
//            $data->padding1 = $paddings[0]=='auto'?'':$paddings[0];
//            $data->padding2 = $paddings[1]=='auto'?'':$paddings[1];
//        } else {
//            $data->padding1 = 0;
//            $data->padding2 = 0;
//        }
//        if ($data->border) {
//            $borders = explode('-',$data->border);
//            $data->border1 = $borders[0];
//            $data->border2 = $borders[1];
//            $data->border3 = $borders[2];
//            $data->border4 = $borders[3];
//        } else {
//            $data->border1 = '';
//            $data->border2 = 0;
//            $data->border3 = 0;
//            $data->border4 = '';
//        }
//        return $data;
//    }

    /**
     * 初始化图片信息
     */
    public function getOnePic($data)
    {
        $picArr = $data->img?unserialize($data->img):[];
        if (!$picArr) {
            $picArr['pic_id'] = 0;
            $picArr['pic_margin1'] = 0;
            $picArr['pic_margin2'] = 0;
            $picArr['pic_padding1'] = 0;
            $picArr['pic_padding2'] = 0;
            $picArr['pic_border1'] = 0;
            $picArr['pic_border2'] = 0;
            $picArr['pic_border3'] = '';
            $picArr['pic_border4'] = '';
            $picArr['pic_width'] = 0;
            $picArr['pic_height'] = 0;
            $picArr['updated_at'] = '0000-00-00 00:00:00';
        }
        $picArr['id'] = $data->id;
        return $picArr;
    }

    /**
     * 初始化文字信息
     */
    public function getOneText($data)
    {
        $textArr = $data->text?unserialize($data->text):[];
        if (!$textArr) {
            $textArr['text_con'] = '';
            $textArr['text_margin1'] = 0;
            $textArr['text_margin2'] = 0;
            $textArr['text_padding1'] = 0;
            $textArr['text_padding2'] = 0;
            $textArr['text_border1'] = 0;
            $textArr['text_border2'] = 0;
            $textArr['text_border3'] = '';
            $textArr['text_border4'] = '';
            $textArr['text_font_size'] = 0;
            $textArr['text_color'] = '';
            $picArr['updated_at'] = '0000-00-00 00:00:00';
        }
        $textArr['id'] = $data->id;
        return $textArr;
    }

    public function getAttrs($data)
    {
        $attrs = $data->attrs?unserialize($data->attrs):[];
        if (!$attrs) {
            $attrs = [
                'ismargin'=> '',
                'margin1'=> '',
                'margin2'=> '',
                'margin3'=> '',
                'margin4'=> '',
                'margin5'=> '',
                'margin6'=> '',
                'ispadding'=> '',
                'ispadding2'=> '',
                'ispadding1'=> '',
                'ispadding3'=> '',
                'ispadding4'=> '',
                'ispadding5'=> '',
                'ispadding6'=> '',
                'width'=> '',
                'height'=> '',
                'border1'=> '',
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
                'left'=> '',
                'top'=> '',
                'overflow'=> '',
                'opacity'=> '',
            ];
        }
        return $attrs;
    }
}