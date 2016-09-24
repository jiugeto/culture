<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductLayerAttrModel;

class ProductLayerAttrController extends BaseController
{
    /**
     * 系统后台 动画属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '动画属性列表';
        $this->crumb['category']['name'] = '动画属性';
        $this->crumb['category']['url'] = 'proLayerAttr';
        $this->model = new ProductLayerAttrModel();
    }

    public function index($productid,$layerid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($productid,$layerid),
            'layerName'=> $this->getLayer($layerid),
            'prefix_url'=> DOMAIN.'admin/'.$productid.'/'.$layerid.'/proLayerAttr',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proLayerAttr.index', $result);
    }

    public function create($productid,$layerid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'layerName'=> $this->getLayer($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proLayerAttr.create', $result);
    }

    public function store(Request $request,$productid,$layerid)
    {
        $data = $this->getData($request,$productid,$layerid);
        $data['created_at'] = time();
        ProductLayerAttrModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proLayerAttr');
    }

    public function edit($productid,$layerid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerName'=> $this->getLayer($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proLayerAttr.edit', $result);
    }

    public function update(Request $request,$productid,$layerid,$id)
    {
        $data = $this->getData($request,$productid,$layerid);
        $data['updated_at'] = time();
        ProductLayerAttrModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proLayerAttr');
    }

    public function show($layerid,$id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerName'=> $this->getLayer($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.proLayerAttr.show', $result);
    }

    public function forceDelete($productid,$layerid,$id)
    {
        ProductLayerAttrModel::where('id',$id)->delete();
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proLayerAttr');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request,$productid,$layerid)
    {
        $data = [
            'productid'=> $productid,
            'layerid'=> $layerid,
            'attrSel'=> $request->attrSel,
            'per'=> $request->per,
            'val'=> $request->val,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($productid,$layerid)
    {
        $datas = ProductLayerAttrModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 获取动画设置名称
     */
    public function getLayer($layerid)
    {
        $layerModel = ProductLayerModel::find($layerid);
        return $layerModel ? $layerModel->name : '';
    }
}