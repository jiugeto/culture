<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiEntertain;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiBusiness\ApiWorks;
use App\Models\EntertainModel;
use App\Models\StaffModel;
use App\Models\WorksModel;

class EntertainController extends BaseController
{
    /**
     * 网站前台娱乐频道
     */

    protected $curr = 'entertain';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre0=1,$genre=0)
    {
        if ($genre0==1) {
            $prefix_url = DOMAIN.'entertain';
        } elseif ($genre0==2) {
            $prefix_url = DOMAIN.'entertain/2/0';
        } else {
            $prefix_url = DOMAIN.'entertain/3/0';
        }
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $datas = $this->query($genre0,$genre,$pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'     => $datas,
            'pagelist'  => $pagelist,
            'ads'       => $this->ads(),
            'lists'     => $this->list,
            'staffModel'    => $this->getStaffModel(),
            'prefix_url'    => $prefix_url,
            'curr_menu' => $this->curr,
            'genre0'    => $genre0,
            'genre'     => $genre,
        ];
        return view('home.entertain.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '公司详情';
        $apiEntertain = ApiEntertain::show($id);
        if ($apiEntertain['code']!==0) {
            echo "<script>alert('".$apiEntertain['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'lists'=> $this->list,
            'data'=> $apiEntertain['data'],
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $apiEntertain['data']['uid'],
        ];
        return view('home.entertain.show', $result);
    }

    public function staffShow($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '人员详情';
        $apiStaff = ApiStaff::show($id);
        if ($apiStaff['code']!==0) {
            echo "<script>alert('".$apiStaff['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiStaff['data'],
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $apiStaff['data']['uid'],
        ];
        return view('home.entertain.staffShow', $result);
    }

    public function worksShow($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '作品详情';
        $apiWorks = ApiWorks::show($id);
        if ($apiWorks['code']!==0) {
            echo "<script>alert('".$apiWorks['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiWorks['data'],
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $apiWorks['data']['uid'],
        ];
        return view('home.entertain.worksShow', $result);
    }





    /**
     * 只显示供应的
     */
    public function query($genre0,$genre,$pageCurr)
    {
        if ($genre0==1) {
            $apiData = ApiEntertain::index($this->limit,$pageCurr,0,1,2,0);
        } elseif ($genre0==2) {
            $apiData = ApiStaff::index($this->limit,$pageCurr,0,$genre,0,2,0);
        } else {
            $apiData = ApiWorks::index($this->limit,$pageCurr,0,0,2,0);
        }
        return $apiData['code']==0 ? $apiData['data'] : [];
    }

    public function ads()
    {
        //adplace_id==4，前台娱乐页面右侧，limit==1
        $apiAd = ApiAd::index(1,1,0,4,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getStaffModel()
    {
        $apiStaff = ApiStaff::getModel();
        return $apiStaff['code']==0 ? $apiStaff['model'] : [];
    }
}