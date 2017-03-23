<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiBusiness\ApiGoods;

class HomeController extends BaseController
{
    /**
     * 个人后台首页
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index($from=1)
    {
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if ($from==1) {
            $prefix_url = DOMAIN.'person';
            $apiData = ApiGoods::index($this->limit,$pageCurr,$this->userid,0,0,0,2);
        } else {
            $prefix_url = DOMAIN.'person/s/'.$from;
            $apiData = ApiDesign::index($this->limit,$pageCurr,$this->userid,0,0,2,0);
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
            'user' => $this->user,
            'from' => $from,
        ];
        return view('person.home.index', $result);
    }
}