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
        return redirect('/member/prioductattr');
    }




    /**
     * 数据收集
     */
    public function getData(Request $request)
    {
        //外边距：margin1上下，margin2左右，
        if (in_array($request->ismargin,[1,2])) {
            $margin1 = ''; $margin2 = ''; $margin3 = '';
            $margin4 = ''; $margin5 = ''; $margin6 = '';
        }
        if ($request->ismargin==3) {
            $margin1 = 'auto'; $margin2 = $request->margin2; $margin3 = '';
            $margin4 = ''; $margin5 = ''; $margin6 = '';
        }
        if ($request->ismargin==4) {
            $margin1 = $request->margin1; $margin2 = 'auto'; $margin3 = '';
            $margin4 = ''; $margin5 = ''; $margin6 = '';
        }
        if ($request->ismargin==4) {
            $margin1 = ''; $margin2 = ''; $margin3 = $request->margin3;
            $margin4 = $request->margin4; $margin5 = $request->margin5; $margin6 = $request->margin6;
        }
        //内边距margin1上下，margin2左右，
        if (in_array($request->ispadding,[1,2])) {
            $padding1 = ''; $padding2 = ''; $padding3 = '';
            $padding4 = ''; $padding5 = ''; $padding6 = '';
        }
        if ($request->ispadding==3) {
            $padding1 = 'auto'; $padding2 = $request->padding2; $padding3 = '';
            $padding4 = ''; $padding5 = ''; $padding6 = '';
        }
        if ($request->ispadding==4) {
            $padding1 = $request->padding1; $padding2 = 'auto'; $padding3 = '';
            $padding4 = ''; $padding5 = ''; $padding6 = '';
        }
        if ($request->ispadding==4) {
            $padding1 = ''; $padding2 = ''; $padding3 = $request->padding3;
            $padding4 = $request->padding4; $padding5 = $request->padding5; $padding6 = $request->padding6;
        }
        //边框
        $attrs = [
            'ismargin'=> $request->iamargin,
            'margin1'=> isset($margin1)?$margin1:'',
            'margin2'=> isset($margin2)?$margin2:'',
            'margin3'=> isset($margin3)?$margin3:'',
            'margin4'=> isset($margin4)?$margin4:'',
            'margin5'=> isset($margin5)?$margin5:'',
            'margin6'=> isset($margin6)?$margin6:'',
            'ispadding'=> $request->ispadding,
            'padding1'=> isset($padding1)?$padding1:'',
            'padding2'=> isset($padding2)?$padding2:'',
            'padding3'=> isset($padding3)?$padding3:'',
            'padding4'=> isset($padding4)?$padding4:'',
            'padding5'=> isset($padding5)?$padding5:'',
            'padding6'=> isset($padding6)?$padding6:'',
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