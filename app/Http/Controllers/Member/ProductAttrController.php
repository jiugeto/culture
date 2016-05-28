<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductAttrModel;
use Illuminate\Http\Request;

class ProductAttrController extends BaseController
{
    /**
     * 会员后台 在线动画 属性管理
     */

    protected $prefix_attr = 'attr_';       //样式属性前缀

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
            'index'=> 1,    //属性级别索引
        ];
        return view('member.productattr.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        //属性名：属性前缀+用户ID+产品id+随机值
        $uid = $this->userid ? $this->userid : 0;
        $attrs['style_name'] = $this->prefix_attr.$uid.'_'.$request->productid.rand(0,1000);
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
            'index'=> 1,    //属性级别索引
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

    /**
     * 二级样式编辑
     */
    public function edit2($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ProductAttrModel::find($id);
        $attrs = $data->attrs2 ? unserialize($data->attrs2) : $this->attrs();
        $attrs['switch'] = isset($attrs['switch2']) ? $attrs['switch2'] : 0;
        $result = [
            'data'=> $data,
            'attrs'=> $attrs,
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> 2,    //属性级别索引
        ];
        return view('member.productattr.edit2', $result);
    }

    /**
     * 二级样式更新
     */
    public function update2(Request $request, $id)
    {
//        dd(2,$request->all());
        $data = $this->toAttrs($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $data['switch'.$request->index] = $request->switch;
        ProductAttrModel::where('id',$id)->update(['attrs2'=> serialize($data)]);
        return redirect('/member/productattr');
    }

    /**
     * 三级样式编辑
     */
    public function edit3($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ProductAttrModel::find($id);
        $attrs = $data->attrs3 ? unserialize($data->attrs3) : $this->attrs();
        $attrs['switch'] = isset($attrs['switch3']) ? $attrs['switch3'] : 0;
        $result = [
            'data'=> $data,
            'attrs'=> $attrs,
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> 3,    //属性级别索引
        ];
        return view('member.productattr.edit2', $result);
    }

    /**
     * 三级样式更新
     */
    public function update3(Request $request, $id)
    {
//        dd(3,$request->all());
        $data = $this->toAttrs($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $data['switch'.$request->index] = $request->switch;
        ProductAttrModel::where('id',$id)->update(['attrs3'=> serialize($data)]);
        return redirect('/member/productattr');
    }

    /**
     * 图片样式编辑
     */
    public function edit4($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ProductAttrModel::find($id);
        $attrs = $data->img ? unserialize($data->img) : $this->imgs();
        $attrs['switch'] = isset($attrs['switch4']) ? $attrs['switch4'] : 0;
        $result = [
            'data'=> $data,
            'attrs'=> $attrs,
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> 4,    //属性级别索引
        ];
        return view('member.productattr.edit2', $result);
    }

    /**
     * 图片样式更新
     */
    public function update4(Request $request, $id)
    {
//        dd(4,$request->all());
        $data = $this->toAttrs($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $data['switch'.$request->index] = $request->switch;
        ProductAttrModel::where('id',$id)->update(['img'=> serialize($data)]);
        return redirect('/member/productattr');
    }

    /**
     * 文字样式编辑
     */
    public function edit5($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ProductAttrModel::find($id);
        $attrs = $data->text ? unserialize($data->text) : $this->attrs();
        $attrs['switch'] = isset($attrs['switch5']) ? $attrs['switch5'] : 0;
        $result = [
            'data'=> $data,
            'attrs'=> $attrs,
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> 5,    //属性级别索引
        ];
        return view('member.productattr.edit2', $result);
    }

    /**
     * 文字样式更新
     */
    public function update5(Request $request, $id)
    {
//        dd(5,$request->all());
        $data = $this->toAttrs($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $data['switch'.$request->index] = $request->switch;
        ProductAttrModel::where('id',$id)->update(['text'=> serialize($data)]);
        return redirect('/member/productattr');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = ProductAttrModel::find($id);
        $result = [
            'data'=> $data,
            'attrs'=> $data->attrs ? unserialize($data->attrs) : [],
            'attrs2'=> $data->attrs2 ? unserialize($data->attrs2) : [],
            'attrs3'=> $data->attrs3 ? unserialize($data->attrs3) : [],
            'pics'=> $data->img ? unserialize($data->img) : [],
            'texts'=> $data->text ? unserialize($data->text) : [],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productattr.show', $result);
    }

    public function show2($id,$index)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = ProductAttrModel::find($id);
        if ($index==1) { $attrs = $this->getAttrs($data); }
        elseif ($index==2) { $attrs = $this->getAttrs2($data); }
        elseif ($index==3) { $attrs = $this->getAttrs3($data); }
        elseif ($index==4) { $attrs = $this->getImg($data); }
        elseif ($index==5) { $attrs = $this->getText($data); }
        $result = [
            'data'=> $data,
            'attrs'=> isset($attrs) ? $attrs : [],
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> $index,
        ];
        return view('member.productattr.show2', $result);
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
        $attrs = $this->toAttrs($request);
        if ($request->index==1) { $switch = 'switch'; }else{ $switch = 'switch'.$request->index; }
        $attrs[$switch] = $request->switch;
        $data = [
            'name'=> $request->name,
            'productid'=> $request->productid,
            'attrs'=> serialize($attrs),
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 属性收集
     */
    public function toAttrs(Request $request)
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
        $attrs =  array(
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
            'position'=> $request->position,
            'left'=> $request->left,
            'top'=> $request->top,
            'overflow'=> $request->overflow,
            'opacity'=> $request->opacity,
        );
        if (in_array($request->index,[1,2,3,5])) {
            $attrs['iscolor'] = $request->iscolor;
            $attrs['color'] = $request->color;
            $attrs['font_size'] = $request->font_size;
            $attrs['word_spacing'] = $request->word_spacing;
            $attrs['line_height'] = $request->line_height;
            $attrs['text_transform'] = $request->text_transform;
            $attrs['text_align'] = $request->text_align;
            $attrs['isbackground'] = $request->isbackground;
            $attrs['background'] = $request->background;
        }
        return $attrs;
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
     * 转换数据 attrs
     */
    public function getAttrs($data)
    {
        $attrs = $data->attrs?unserialize($data->attrs):[];
        if (!$attrs) { $attrs = $this->attrs(); $attrs['switch'] = 0; }
        return $attrs;
    }

    /**
     * 转换数据 attrs2
     */
    public function getAttrs2($data)
    {
        $attrs = $data->attrs2?unserialize($data->attrs2):[];
        if (!$attrs) { $attrs = $this->attrs(); $attrs['switch2'] = 0; }
        return $attrs;
    }

    /**
     * 转换数据 attrs3
     */
    public function getAttrs3($data)
    {
        $attrs = $data->attrs3?unserialize($data->attrs3):[];
        if (!$attrs) { $attrs = $this->attrs(); $attrs['switch3'] = 0; }
        return $attrs;
    }

    /**
     * 转换数据 img
     */
    public function getImg($data)
    {
        $attrs = $data->img?unserialize($data->img):[];
        if (!$attrs) { $attrs = $this->attrs(); $attrs['switch4'] = 0; }
        return $attrs;
    }

    /**
     * 转换数据 text
     */
    public function getText($data)
    {
        $attrs = $data->text?unserialize($data->text):[];
        if (!$attrs) { $attrs = $this->attrs(); $attrs['switch5'] = 0; }
        return $attrs;
    }

    /**
     * 初始化 attrs
     */
    public function attrs()
    {
        return array(
            'ismargin'=> 0,
            'margin1'=> '',
            'margin2'=> '',
            'margin3'=> '',
            'margin4'=> '',
            'margin5'=> '',
            'margin6'=> '',
            'ispadding'=> 0,
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
            'iscolor'=> 0,
            'color'=> '',
            'font_size'=> '',
            'word_spacing'=> '',
            'line_height'=> '',
            'text_transform'=> '',
            'text_align'=> '',
            'isbackground'=> 0,
            'background'=> '',
            'position'=> '',
            'left'=> '',
            'top'=> '',
            'overflow'=> '',
            'opacity'=> '',
        );
    }

    /**
     * 初始化 imgs
     */
    public function imgs()
    {
        return array(
            'ismargin'=> 0,
            'margin1'=> '',
            'margin2'=> '',
            'margin3'=> '',
            'margin4'=> '',
            'margin5'=> '',
            'margin6'=> '',
            'ispadding'=> 0,
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
            'position'=> '',
            'left'=> '',
            'top'=> '',
            'overflow'=> '',
            'opacity'=> '',
        );
    }
}