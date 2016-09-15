<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\AdModel;
use App\Models\Base\AdPlaceModel;
use App\Models\Base\PicModel;
use Illuminate\Http\Request;

class AdController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '广告列表';
        $this->crumb['category']['name'] = '广告管理';
        $this->crumb['category']['url'] = 'ad';
        $this->model = new AdModel();
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/ad',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        //广告位的广告数量限制
        $adplaceModel = AdPlaceModel::find($data['adplace_id']);
        $adModels = AdModel::where('adplace_id',$data['adplace_id'])->get();
        if ($adplaceModel && count($adModels)>=$adplaceModel->number) {
            echo "<script>alert('该广告位的广告数量最多".$adplaceModel->number."个，已到上限！');history.go(-1);</script>";exit;
        }
        $data['created_at'] = time();
        AdModel::create($data);
        return redirect(DOMAIN.'admin/ad');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> AdModel::find($id),
            'model'=> $this->model,
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        AdModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/ad');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> AdModel::find($id),
            'model'=> $this->model,
//            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.show', $result);
    }

    public function setUse($id,$use)
    {
        AdModel::where('id',$id)->update(array('isuse'=> $use));
        return redirect(DOMAIN.'admin/ad');
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->adplace || !$request->pic_id || !$request->fromTime || !$request->toTime) {
            echo "<script>alert('广告名称、广告位、图片、有效时间必填选！');history.go(-1);</script>";exit;
        }
        //判断广告位尺寸和图片尺寸
        $picModel = PicModel::find($request->pic_id);
        $adPlaceModel = AdPlaceModel::find($request->adplace);
        if ($picModel->width < $adPlaceModel->width) {
            echo "<script>alert('所选图片宽度小于广告位宽度！');history.go(-1);</script>";exit;
        }
        if ($picModel->height < $adPlaceModel->height) {
            echo "<script>alert('所选图片高度小于广告位高度！');history.go(-1);</script>";exit;
        }
        if (strtotime($request->fromTime) > strtotime($request->toTime)) {
            echo "<script>alert('有效结束时间不能早于开始时间！');history.go(-1);</script>";exit;
        }
        return array(
            'name'=> $request->name,
            'adplace_id'=> $request->adplace,
            'intro'=> $request->intro,
            'pic_id'=> $request->pic_id,
            'link'=> $request->link,
            'fromTime'=> strtotime($request->fromTime.'000000'),
            'toTime'=> strtotime($request->toTime.'235959'),
            //uid==0，则是系统添加
//            'uid'=> $this->userid,
        );
    }

    public function query()
    {
        $datas = AdModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}