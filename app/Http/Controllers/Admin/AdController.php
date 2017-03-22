<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiAdPlace;
use App\Api\ApiUser\ApiUsers;
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
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/ad';
        $apiAd = ApiAd::index($this->limit,$pageCurr,0,0,0,0,0,0);
        if ($apiAd['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiAd['data']; $total = $apiAd['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.ad.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'adplaces' => $this->getAdPlaces(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        //广告位的广告数量限制
        //?????
        $apiAd = ApiAd::add($data);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ad');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiAd = ApiAd::show($id);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiAd['data'],
            'model' => $this->getModel(),
            'adplaces' => $this->getAdPlaces(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.ad.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiAd = ApiAd::modify($data);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ad');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiAd = ApiAd::show($id);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiAd['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.show', $result);
    }

    /**
     * 设置图片
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        //判断老图片
        $apiAd = ApiAd::show($id);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiAd['data']['thumb']) {
            $thumbArr = explode('/',$thumbOld);
            unset($thumbArr[0]); unset($thumbArr[1]); unset($thumbArr[2]);
            $path = implode('/',$thumbArr);
        }
        $pathOld = isset($path) ? $path : '';
        //上传图片
        $rstArr=$this->uploadOnlyImg($request->url_ori,$pathOld);
        if ($rstArr['code']!=0) {
            echo "<script>alert('".$rstArr['msg']."');history.go(-1);</script>";exit;
        }
        $thumb = $rstArr['data'];
        $data = [
            'id'    =>  $id,
            'thumb' =>  isset($thumb) ? $thumb : '',
        ];
        $apiAd = ApiAd::setThumb($data);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ad');
    }

    public function setUse($id,$isuse)
    {
        $apiAd = ApiAd::setUse($id,$isuse);
        if ($apiAd['code']!=0) {
            echo "<script>alert('".$apiAd['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/ad');
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->adplace) {
            echo "<script>alert('广告名称、广告位必填选！');history.go(-1);</script>";exit;
        }
        if (strtotime($request->fromTime) > strtotime($request->toTime)) {
            echo "<script>alert('有效结束时间不能早于开始时间！');history.go(-1);</script>";exit;
        }
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        return array(
            'name'=> $request->name,
            'adplace'=> $request->adplace,
            'intro'=> $request->intro,
            'link'=> $request->link,
            'fromTime'=> strtotime($request->fromTime.'000000'),
            'toTime'=> strtotime($request->toTime.'235959'),
            'uid'=> $apiUser['data']['id'],
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiAd::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 获取广告位
     */
    public function getAdPlaces()
    {
        $apiAdPlace = ApiAdPlace::getAdPlaceAll();
        return $apiAdPlace['code']==0 ? $apiAdPlace['data'] : [];
    }
}