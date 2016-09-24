<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductLayerModel;
use App\Models\Online\ProductConModel;
use Illuminate\Http\Request;

class ProductConController extends BaseController
{
    /**
     * 系统后台 产品动画的图片文字管理
     */

    protected $layerModel;

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '图文列表';
        $this->crumb['category']['name'] = '图文管理';
        $this->crumb['category']['url'] = 'proCon';
        $this->model = new ProductConModel();
        $this->layerModel = new ProductLayerModel();
    }

    public function index($productid,$layerid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($productid,$layerid),
            'prefix_url'=> DOMAIN.'admin/'.$productid.'/'.$layerid.'/proCon',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
            'layerid'=> $layerid,
        ];
        return view('admin.proCon.index', $result);
    }

    public function create($productid,$layerid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'pics'=> $this->model->picAll(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proCon.create', $result);
    }

    public function store(Request $request,$productid,$layerid)
    {
        $data = $this->getData($request,$productid,$layerid);
        $data['created_at'] = time();
        ProductConModel::create($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proCon');
    }

    public function edit($productid,$layerid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductConModel::find($id),
            'pics'=> $this->model->picAll(),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $productid,
            'layerid'=> $layerid,
        ];
        return view('admin.proCon.edit', $result);
    }

    public function update(Request $request,$productid,$layerid,$id)
    {
        $data = $this->getData($request,$productid,$layerid);
        $data['updated_at'] = time();
        ProductConModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$productid.'/'.$layerid.'/proCon');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request,$productid,$layerid)
    {
        if ($request->genre==1 && !$request->pic_id) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->genre==2 && !$request->name) {
            echo "<script>alert('名称必填！');history.go(-1);</script>";exit;
        }
        $data = [
            'productid'=> $productid,
            'layerid'=> $layerid,
            'genre'=> $request->genre,
            'pic_id'=> $request->pic_id,
            'name'=> $request->name,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($productid,$layerid)
    {
        $datas = ProductConModel::where('productid',$productid)
            ->where('layerid',$layerid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}