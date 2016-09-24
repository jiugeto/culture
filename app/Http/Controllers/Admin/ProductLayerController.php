<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductLayerAttrModel;
use App\Models\Online\ProductLayerModel;
use Illuminate\Http\Request;

class ProductLayerController extends BaseController
{
    /**
     * 系统后台 内部产品动画层级管理
     */

    protected $attrModel;
    protected $prefix_dh = 'layer_';     //动画名称前缀 dh->donghua

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '动画设置列表';
        $this->crumb['category']['name'] = '动画设置';
        $this->crumb['category']['url'] = 'proLayer';
        $this->model = new ProductLayerModel();
    }

    public function index($productid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($productid),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'admin/'.$productid.'/proLayer',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
        return view('admin.proLayer.index', $result);
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
       return view('admin.proLayer.create', $result);
    }

    public function store(Request $request,$productid)
    {
        $data = $this->getData($request,$productid);
        $data['a_name'] = $this->prefix_dh.$productid.'_'.rand(0,10000);
        $data['created_at'] = time();
        ProductLayerModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proLayer');
    }

    public function edit($productid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductLayerModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
        ];
        return view('admin.proLayer.edit', $result);
    }

    public function update(Request $request,$productid,$id)
    {
        $data = $this->getData($request,$productid);
        $data['updated_at'] = time();
        ProductLayerModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/proLayer');
    }

    public function show($productid,$id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductLayerModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.proLayer.show', $result);
    }





    /**
     * 查询动画设置
     */
    public function query($productid)
    {
        $datas = ProductLayerModel::where('productid',$productid)
            ->orderBy('delay','asc')
            ->orderBy('id','asc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 收集数据
     */
    public function getData(Request $request,$productid)
    {
        $data = [
            'name'=> $request->name,
            'productid'=> $productid,
            'timelong'=> $request->timelong,
            'func'=> $request->func,
            'delay'=> $request->delay,
        ];
        return $data;
    }
}