<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiDelivery;
use App\Api\ApiUser\ApiUsers;

class DeliveryController extends BaseController
{
    /**
     * 视频投放媒介
     */

    protected $curr = 'delivery';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=0)
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($genre) {
            $prefix_url = DOMAIN.'delivery/s/'.$genre;
        } else {
            $prefix_url = DOMAIN.'delivery';
        }
        $apiDelivery = ApiDelivery::index($this->limit,$pageCurr,$this->userid,$genre,2,0);
        if ($apiDelivery['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiDelivery['data']; $total = $apiDelivery['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'ads' => $this->ads(),
            'lists' => $this->list,
            'curr_menu' => $this->curr,
            'genre' => $genre,
        ];
        return view('home.delivery.index',$result);
    }

    public function show($id)
    {
        $apiDelivery = ApiDelivery::show($id);
        if ($apiDelivery['code']!=0) {
            echo "<script>alert('".$apiDelivery['msg']."');history.go(-1);</script>";exit;
        }
        //获取用户信息
        $apiUser = ApiUsers::getOneUser($apiDelivery['data']['uid']);
        if ($apiUser['code']!=0) {
            echo "<script>alert('没有该用户！');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiDelivery['data'],
            'userInfo' => $apiUser['data'],
        ];
        return view('home.delivery.show',$result);
    }





    public function ads()
    {
        //adplace_id==3，前台需求页面右侧，limit==2
        $apiAd = ApiAd::index(2,1,0,3,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiDelivery::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}