<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ActionModel;
use App\Models\AdPlaceModel;

class AdPlaceController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdPlaceModel();
        $this->crumb['']['name'] = '广告位列表';
        $this->crumb['category']['name'] = '广告位管理';
        $this->crumb['category']['url'] = 'place';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/place',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.index', $result);
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
        return view('admin.adplace.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        AdPlaceModel::create($data);
        return redirect(DOMAIN.'admin/place');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> AdPlaceModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        AdPlaceModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/place');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> AdPlaceModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.show', $result);
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->width || !$request->height || !$request->price || !$request->number) {
            echo "<script>alert('广告位名称、宽度、高度、价格、数量必填！');history.go(-1);</script>";exit;
        }
       return array(
           'name'=> $request->name,
           'intro'=> $request->intro,
           'width'=> $request->width,
           'height'=> $request->height,
           'price'=> $request->price,
//           'uid'=> $this->userid,
           'number'=> $request->number,
       );
    }

    public function query()
    {
        $datas = AdPlaceModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 收集数据
     */
}