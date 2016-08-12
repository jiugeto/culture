<?php
namespace App\Http\Controllers\Admin;

use App\Models\ProductConModel;
use Illuminate\Http\Request;

class ProductConController extends BaseController
{
    /**
     * 系统后台 产品动画的图片文字管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductConModel();
        $this->crumb['']['name'] = '图片文字列表';
        $this->crumb['category']['name'] = '图片文字';
        $this->crumb['category']['url'] = 'productcon';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/productcon',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/productcon/trash',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.index', $result);
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
        return view('admin.productCon.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductConModel::create($data);
        return redirect('/admin/productcon');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> $this->getOne(ProductConModel::find($id)),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductConModel::where('id',$id)->update($data);
        return redirect('/admin/productcon');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $this->getOne(ProductConModel::find($id)),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productCon.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if ($request->margin1 || $request->margin2) { $margin = $request->margin1.'-'.$request->margin2; }
        if ($request->padding1 || $request->padding2) { $padding = $request->padding1.'-'.$request->padding2; }
        if ($request->border1) {
            if (!$request->border2 || !$request->border3 || !$request->border4) {
                echo "<script>alert('边框宽度、类型或颜色必选填！');history.go(-1);</script>";exit;
            }
            $border = $request->border1.'-'.$request->border1.'-'.$request->border1.'-'.$request->border1.'-';
        }
        $text_attr = $this->getText($request);
        $data = [
            'name'=> $request->name,
            'productid'=> $request->productid,
            'attrid'=> $request->attrid,
            'genre'=> $request->genre,
            'pic_id'=> $request->pic_id,
            'margin'=> isset($margin) ? $margin : '',
            'padding'=> isset($padding) ? $padding : '',
            'width'=> $request->width,
            'height'=> $request->height,
            'border'=> isset($border) ? $border : '',
            'background'=> $request->background,
            'position'=> $request->position,
            'left'=> $request->left,
            'top'=> $request->top,
            'overflow'=> $request->overflow,
            'opacity'=> $request->opacity,
            'text_attr'=> $text_attr,
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     *  文字信息
     */
    public function getText(Request $request)
    {
        $text = [
            'color'=> isset($request->color) ? $request->color : '',
            'font_size'=> isset($request->font_size) ? $request->font_size : 0,
            'word_spacing'=> isset($request->word_spacing) ? $request->word_spacing : 0,
            'line_height'=> isset($request->line_height) ? $request->line_height : 0,
            'text_transform'=> isset($request->text_transform) ? $request->text_transform : 0,
            'text_align'=> isset($request->text_align) ? $request->text_align : 0,
        ];
        return serialize($text);
    }

    /**
     * 查询方法
     */
    public function query($del)
    {
        $datas = ProductConModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 查询一条记录，数据转换
     */
    public function getOne($data)
    {
        //外边距
        if ($data->margin) {
            $margins = explode('-',$data->margin);
            $data->margin1 = $margins[0]; $data->margin2 = $margins[2];
        } else {
            $data->margin1 = ''; $data->margin2 = '';
        }
        //内边距
        if ($data->padding) {
            $paddings = explode('-',$data->padding);
            $data->padding1 = $paddings[0]; $data->padding2 = $paddings[2];
        } else {
            $data->padding1 = ''; $data->padding2 = '';
        }
        //边框
        if ($data->border) {
            $borders = explode('-',$data->border);
            $data->border1 = $borders[0];
            $data->border2 = $borders[1];
            $data->border4 = $borders[2];
            $data->border1 = $borders[3];
        }
        //文字属性
        $data->text = unserialize($data->text_attr);
        return $data;
    }
}