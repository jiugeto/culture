<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductLayerAttrModel;
use App\Models\ProductLayerModel;
use Illuminate\Http\Request;

class ProductLayerAttrController extends BaseController
{
    /**
     * 会员后台 产品动画
     */

    protected $layerid;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '动画属性';
        $this->lists['func']['url'] = 'proLayerAttr';
        $this->lists['create']['name'] = '添加属性动画';
        $this->model = new ProductLayerAttrModel();
    }

    public function index($layerid)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($layerid),
            'layerModel'=> ProductLayerModel::find($layerid),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'member/proLayerAttr',
            'curr'=> $curr,
        ];
        return view('member.proLayerAttr.index', $result);
    }

    public function create($layerid)
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'layerModel'=> ProductLayerModel::find($layerid),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.proLayerAttr.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductLayerAttrModel::create($data);
        return redirect(DOMAIN.'member/proLayerAttr');
    }

    public function edit($layerid,$id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerModel'=> ProductLayerModel::find($layerid),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.proLayerAttr.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductLayerAttrModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/proLayerAttr');
    }

    public function show($layerid,$id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ProductLayerAttrModel::find($id),
            'layerModel'=> ProductLayerModel::find($layerid),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.proLayerAttr.show', $result);
    }

    public function destroy($id)
    {
        ProductLayerAttrModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/proLayerAttr');
    }

    public function restore($id)
    {
        ProductLayerAttrModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/proLayerAttr');
    }

    public function forceDelete($id)
    {
        ProductLayerAttrModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/proLayerAttr');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'productid'=> $request->productid,
            'attrid'=> $request->attrid,
            'layerid'=> $request->layerid,
            'attrSel'=> $request->attrSel,
            'per'=> $request->per,
            'val'=> $request->val,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($layerid)
    {
        return ProductLayerAttrModel::where('layerid',$layerid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}