<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductAttrModel;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * 会员后台 在线动画 属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '产品属性';
        $this->lists['func']['url'] = 'productattr';
        $this->lists['create']['name'] = '添加属性';
        $this->model = new ProductAttrModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productattr',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productattr/trash',
            'curr'=> $curr,
        ];
        return view('member.productattr.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productattr.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ProductAttrModel::create($data);
        return redirect('/member/productattr');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $data,
            'attrs'=> $this->getAttrs($data),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productattr.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ProductAttrModel::where('id',$id)->update($data);
        return redirect('/member/productattr');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $data,
            'attrs'=> $this->getAttrs($data),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productattr.show', $result);
    }

    public function destroy($id)
    {
        ProductAttrModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/productattr');
    }

    public function restore($id)
    {
        ProductAttrModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/productattr/trash');
    }

    public function forceDelete($id)
    {
        ProductAttrModel::where('id',$id)->dalete();
        return redirect('/member/productattr/trash');
    }




    /**
     * 数据收集
     */
    public function getData(Request $request)
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
        if ($request->ispadding==3) {
            $request->padding1 = 'auto';
            if ($request->padding2=='') { echo "<script>alert('左右内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispadding==3) { $request->padding1 = 'auto'; $request->padding2 = 'auto'; }
        if ($request->ispadding==4) {
            $request->padding2 = 'auto';
            if ($request->padding1=='') { echo "<script>alert('上下内边距必填！');history.go(-1);</script>";exit; }
        }
        if ($request->ispadding==5) {
            if ($request->ispadding3=='' || $request->ispadding4=='' || $request->ispadding5=='' || $request->ispadding6=='') {
                echo "<script>alert('上下左右内边距必填！');history.go(-1);</script>";exit;
            }
        }
        //边框
        if ($request->border1) {
            if (!$request->border2 || !$request->border3 || !$request->border4) {
                echo "<script>alert('边框宽度、类型、颜色必填！');history.go(-1);</script>";exit;
            }
        }
        $attrs = [
            'ismargin'=> $request->iamargin,
            'margin1'=> $request->margin1,
            'margin2'=> $request->margin2,
            'margin3'=> $request->margin3,
            'margin4'=> $request->margin4,
            'margin5'=> $request->margin5,
            'margin6'=> $request->margin6,
            'ispadding'=> $request->ispadding,
            'padding1'=> $request->ispadding1,
            'padding2'=> $request->ispadding2,
            'padding3'=> $request->ispadding3,
            'padding4'=> $request->ispadding4,
            'padding5'=> $request->ispadding5,
            'padding6'=> $request->ispadding6,
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
            'position'=> $request->position,
            'left'=> $request->left,
            'top'=> $request->top,
            'overflow'=> $request->overflow,
            'opacity'=> $request->opacity,
        ];
        $data = [
            'name'=> $request->name,
            'style_name'=> $request->style_name,
            'productid'=> $request->productid,
            'attrs'=> serialize($attrs),
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductAttrModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }

    /**
     * 转换数据
     */
    public function getAttrs($data)
    {
        $data->attrs = $data->attrs?unserialize($data->attrs):[];
        if (!$data->attrs) {
            $attrs = [
                'ismargin'=> '',
                'margin1'=> '',
                'margin2'=> '',
                'margin3'=> '',
                'margin4'=> '',
                'margin5'=> '',
                'margin6'=> '',
                'ispadding'=> '',
                'padding1'=> '',
                'padding2'=> '',
                'padding3'=> '',
                'padding4'=> '',
                'padding5'=> '',
                'padding6'=> '',
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
                'position'=> '',
                'left'=> '',
                'top'=> '',
                'overflow'=> '',
                'opacity'=> '',
            ];
        }
        return $attrs;
    }
}