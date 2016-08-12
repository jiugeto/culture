<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductLayerModel;
use App\Models\ProductLayerAttrModel;

class ProductLayerAttrController extends BaseController
{
    /**
     * 系统后台 动画属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductLayerAttrModel();
        $this->crumb['']['name'] = '动画属性列表';
        $this->crumb['category']['name'] = '动画属性';
        $this->crumb['category']['url'] = 'prolayerattr';
    }

    public function index($layerid=null)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($layerid,$del=0),
            'layerModel'=> ProductLayerModel::find($layerid),
            'prefix_url'=> '/admin/prolayerattr',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.prolayerattr.index', $result);
    }

    public function create($layerid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'layerModel'=> ProductLayerModel::find($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.prolayerattr.create', $result);
    }

    public function store(Request $request,$layerid)
    {
        $data = $this->getData($request,$layerid);
        $data['created_at'] = time();
        ProductLayerAttrModel::create($data);
        return redirect('/admin/'.$layerid.'/prolayerattr');
    }

    public function edit($layerid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerModel'=> ProductLayerModel::find($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.prolayerattr.edit', $result);
    }

    public function update(Request $request,$layerid,$id)
    {
        $data = $this->getData($request,$layerid);
        $data['updated_at'] = time();
        ProductLayerAttrModel::where('id',$id)->update($data);
        return redirect('/admin/'.$layerid.'/prolayerattr');
    }

    public function show($layerid,$id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerModel'=> ProductLayerModel::find($layerid),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.prolayerattr.show', $result);
    }

    public function forceDelete($layerid,$id)
    {
        ProductLayerAttrModel::where('id',$id)->delete();
        return redirect('/admin/'.$layerid.'/prolayerattr');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request,$layerid)
    {
        $data = [
            'productid'=> $request->productid,
            'attrid'=> $request->attrid,
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
    public function query($layerid=null,$del)
    {
        if ($layerid==null) {
            $datas = ProductLayerAttrModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ProductLayerAttrModel::where('layerid',$layerid)
                ->where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}