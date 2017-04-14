<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiAdPlace;
use Illuminate\Http\Request;

class PptController extends BaseController
{
    /**
     * 企业页面 ppt管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '宣传编辑';
        $this->lists['func']['url'] = 'ppt';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'ppt';
        $apiPpt = ApiAd::index($this->limit,$pageCurr,$this->userid,0,0,0,0,2);
        if ($apiPpt['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiPpt['data']; $total = $apiPpt['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
            'adplaces' => $this->getAdPlaces(),
            'dayCount' => $this->getDayCountByMonth(),
        ];
        return view('company.admin.ppt.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getPptData($request);
        $apiAd = ApiAd::add($data);
        if ($apiAd['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'ppt');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiAd = ApiAd::show($id);
        if ($apiAd['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiAd['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
            'adplaces' => $this->getAdPlaces(),
            'dayCount' => $this->getDayCountByMonth(),
        ];
        return view('company.admin.ppt.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getPptData($request);
        $data['id'] = $id;
        $apiAd = ApiAd::modify($data);
        if ($apiAd['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'ppt');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiAd = ApiAd::show($id);
        if ($apiAd['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiAd['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.show', $result);
    }




    /**
     * 收集数据
     */
    public function getPptData(Request $request)
    {
        if ($request->isperiod==0) {
            $fromTime = 0; $toTime = 0;
        } else {
            if (!$request->from_y || !$request->from_m || !$request->from_d) {
                echo "<script>alert('起始年月日未填写完整！');history.go(-1);</script>";exit;
            }
            if (!$request->to_y || !$request->to_m || !$request->to_d) {
                echo "<script>alert('结束年月日未填写完整！');history.go(-1);</script>";exit;
            }
            $fromTimeStr = $request->from_y . $request->from_m . $request->from_d;
            $toTimeStr = $request->to_y . $request->to_m . $request->to_d;
            $fromTime = strtotime($fromTimeStr);
            $toTime = strtotime($toTimeStr);
        }
        return array(
            'name'          =>  $request->name,
            'adplace'   =>  $request->adplace,
            'intro'     =>  $request->intro,
            'link'      =>  $request->link,
            'fromTime'  =>  $fromTime,
            'toTime'    =>  $toTime,
            'uid'       =>  $this->userid,
        );
    }

    /**
     * 获取该企业所有广告位
     */
    public function getAdPlaces()
    {
        $apiAdPlace = ApiAdPlace::index(100,1,0);
        return $apiAdPlace['code']==0 ? $apiAdPlace['data'] : [];
    }

    /**
     * 计算当前月份
     */
    public function getDayCountByMonth()
    {
        $yue = date('m',time());
        if (in_array($yue,[1,3,5,7,8,10,12])) {
            $count = 31;
        } else if (in_array($yue,[6,9,11])) {
            $count = 30;
        } else  if ($yue==2) {
            $count = 28;
        }
        return isset($count) ? $count : 30;
    }
}