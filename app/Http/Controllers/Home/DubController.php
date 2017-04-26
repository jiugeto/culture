<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiDub;
use App\Api\ApiUser\ApiUsers;

class DubController extends BaseController
{
    /**
     * 配音
     */

    protected $curr = 'dub';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=0)
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($genre) {
            $prefix_url = DOMAIN.'dub/'.$genre;
        } else {
            $prefix_url = DOMAIN.'dub';
        }
        $apiDub = ApiDub::index($this->limit,$pageCurr,$this->userid,$genre,2,0);
        if ($apiDub['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiDub['data']; $total = $apiDub['pagelist']['total'];
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
        return view('home.dub.index',$result);
    }

    public function show($id)
    {
        $apiDub = ApiDub::show($id);
        if ($apiDub['code']!=0) {
            echo "<script>alert('".$apiDub['msg']."');history.go(-1);</script>";exit;
        }
        //获取用户信息
        $apiUser = ApiUsers::getOneUser($apiDub['data']['uid']);
        if ($apiUser['code']!=0) {
            echo "<script>alert('没有该用户！');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiDub['data'],
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
        $apiModel = ApiDub::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}