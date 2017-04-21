<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiBusiness\ApiIdea;
use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiUser\ApiUsers;

class DemandController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    protected $curr = 'demand';
    protected $genres = [
        1=>'人员','故事','设备','设计',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=2)
    {
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'demand';
        if ($genre==1) {
            //人员需求
            $apiData = ApiStaff::index($this->limit,$pageCurr,0,2,0,2,0);
        } else if ($genre==2) {
            //故事需求
            $apiData = ApiIdea::index($this->limit,$pageCurr,0,2);
        } else if ($genre==3) {
            //设备需求
            $apiData = ApiRent::index($this->limit,$pageCurr,0,2,0,2,0);
        } else {
            //设计需求
            $apiData = ApiDesign::index($this->limit,$pageCurr,[2,4],2,0);
        }
        if ($apiData['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiData['data']; $total = $apiData['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'ads' => $this->ads(),
            'lists' => $this->list,
            'curr_menu' => $this->curr,
            'genres' => $this->genres,
            'genre' => $genre,

        ];
        return view('home.demand.index', $result);
    }

    public function getShowByGenre($genre,$id)
    {
        if (!$genre || !$id) {
            echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
        }
        if ($genre==1) {
            $apiData = ApiStaff::show($id);
            $genreName = '人员';
        } else if ($genre==2) {
            $apiData = ApiIdea::show($id);
            $genreName = '故事';
        } else if ($genre==3) {
            $apiData = ApiRent::show($id);
            $genreName = '租赁';
        } else {
            $apiData = ApiDesign::show($id);
            $genreName = '设计';
        }
        if ($apiData['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        //获取需求者信息
        $apiUser = ApiUsers::getOneUser($apiData['data']['uid']);
        if ($apiUser['code']!=0) {
            echo "<script>alert('需求用户不存在！');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiData['data'],
            'genre' => $genre,
            'genreName' => $genreName,
            'userInfo' => $apiUser['data'],
        ];
        return view('home.demand.show',$result);
    }







    public function ads()
    {
        //adplace_id==3，前台需求页面右侧，limit==2
        $apiAd = ApiAd::index(2,1,0,3,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }
}