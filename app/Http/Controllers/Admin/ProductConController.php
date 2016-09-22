<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\ProductAttrModel;
use App\Models\Online\ProductConModel;
use Illuminate\Http\Request;

class ProductConController extends BaseController
{
    /**
     * 系统后台 产品动画的图片文字管理
     */

    protected $attrModel;

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '图文列表';
        $this->crumb['category']['name'] = '图文管理';
        $this->crumb['category']['url'] = 'proCon';
        $this->model = new ProductConModel();
        $this->attrModel = new ProductAttrModel();
    }

    public function index($attrid)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($attrid),
            'prefix_url'=> DOMAIN.'admin/'.$attrid.'/proCcon',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'productid'=> $this->getAttrIdByProductId($attrid),
            'attrid'=> $attrid,
        ];
        return view('admin.proCon.index', $result);
    }

    public function create($attrid)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'pics'=> $this->model->picAll(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'attrModel'=> ProductAttrModel::find($attrid),
        ];
        return view('admin.proCon.create', $result);
    }

    public function store(Request $request,$attrid)
    {
        $data = $this->getData($request);
        $data['attrid'] = $attrid;
        $data['created_at'] = time();
        ProductConModel::create($data);
        return redirect(DOMAIN.'admin/'.$attrid.'/proCon');
    }

    public function edit($attrid,$id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductConModel::find($id),
            'pics'=> $this->model->picAll(),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'attrModel'=> ProductAttrModel::find($attrid),
        ];
        return view('admin.proCon.edit', $result);
    }

    public function update(Request $request,$attrid,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ProductConModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/'.$attrid.'/proCon');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if ($request->genre==1 && !$request->pic_id) {
            echo "<script>alert('图片必选！');history.go(-1);</script>";exit;
        }
        if ($request->genre==2 && !$request->name) {
            echo "<script>alert('名称必填！');history.go(-1);</script>";exit;
        }
        $data = [
            'genre'=> $request->genre,
            'pic_id'=> $request->pic_id,
            'name'=> $request->name,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($attrid)
    {
        $datas = ProductConModel::where('attrid',$attrid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 通过 attrid 得到 productid
     */
    public function getAttrIdByProductId($attrid)
    {
        $attrModel = ProductAttrModel::find($attrid);
        return $attrModel ? $attrModel->productid : 0;
    }
}