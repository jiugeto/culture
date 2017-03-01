<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiAdPlace;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class AdPlaceController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '广告位列表';
        $this->crumb['category']['name'] = '广告位管理';
        $this->crumb['category']['url'] = 'place';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/place';
        $apiAdPlace = ApiAdPlace::index($this->limit,$pageCurr,0);
        if ($apiAdPlace['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiAdPlace['data']; $total = $apiAdPlace['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.adplace.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.create', $result);
    }

//    public function store(Request $request)
//    {
//        $data = $this->getData($request);
//        return redirect(DOMAIN.'admin/place');
//    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiAdPlace = ApiAdPlace::show($id);
        if ($apiAdPlace['code']!=0) {
            echo "<script>alert('".$apiAdPlace['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiAdPlace['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.edit', $result);
    }

//    public function update(Request $request, $id)
//    {
//        $data = $this->getData($request);
//        $data['updated_at'] = time();
//        AdPlaceModel::where('id',$id)->update($data);
//        return redirect(DOMAIN.'admin/place');
//    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiAdPlace = ApiAdPlace::show($id);
        if ($apiAdPlace['code']!=0) {
            echo "<script>alert('".$apiAdPlace['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiAdPlace['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.adplace.show', $result);
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->width || !$request->height || !$request->money || !$request->number) {
            echo "<script>alert('广告位名称、宽度、高度、价格、数量必填！');history.go(-1);</script>";exit;
        }
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
       return array(
           'name'=> $request->name,
           'intro'=> $request->intro,
           'width'=> $request->width,
           'height'=> $request->height,
           'money'=> $request->price,
           'uid'=> $apiUser['data']['id'],
           'number'=> $request->number,
       );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiAdPlace::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}