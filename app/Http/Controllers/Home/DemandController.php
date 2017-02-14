<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiBusiness\ApiIdea;
use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiBusiness\ApiStoryBoard;

class DemandController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    protected $curr = 'demand';
    protected $genres = [
        /*1=>'视频',*/2=>'创意','分镜','人员','设备','设计',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=2)
    {
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'demand';
        $datas = $this->query($genre,$pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'=> $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'ads'=> $this->ads(),
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
//            'model'=> $this->getModel($genre),
            'genres'=> $this->genres,
            'genre'=> $genre,

        ];
        return view('home.demand.index', $result);
    }





    public function query($genre,$pageCurr=1)
    {
        /*if ($genre==1) {
            //视频需求，type==1、3是需求
            $apiData = ApiGoods::index($this->limit,$pageCurr,[1,3],0,2,0,0);
        } else*/if ($genre==2) {
            //创意剧本，genre==2是需求
            $apiData = ApiIdea::index($this->limit,$pageCurr,0,2);
        } elseif ($genre==3) {
            //分镜需求，genre==3是需求
            $apiData = ApiStoryBoard::index($this->limit,$pageCurr,0,2,0);
        } elseif ($genre==4) {
            //人员需求，genre==4是需求
            $apiData = ApiStaff::index($this->limit,$pageCurr,0,2,0,2,0);
        } elseif ($genre==5) {
            //设备需求，genre==5是需求
            $apiData = ApiRent::index($this->limit,$pageCurr,0,2,0,2,0);
        } else {
            //设计需求，genre==6是需求
            $apiData = ApiDesign::index($this->limit,$pageCurr,[2,4],2,0);
        }
        return $apiData['code']==0 ? $apiData['data'] : [];
    }

    public function ads()
    {
        //adplace_id==3，前台需求页面右侧，limit==2
        $apiAd = ApiAd::index(2,1,0,3,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 goodsModel
     */
    public function getModel($genre)
    {
        if ($genre==1) {
            $apiModel = ApiGoods::getModel();
        } elseif ($genre==2) {
            $apiModel = ApiIdea::getModel();
        } elseif ($genre==3) {
            $apiModel = ApiStoryBoard::getModel();
        } elseif ($genre==4) {
            $apiModel = ApiStaff::getModel();
        } elseif ($genre==5) {
            $apiModel = ApiRent::getModel();
        } else {
            $apiModel = ApiDesign::getModel();
        }
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}