<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiDesign;

class DesignController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'design';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($cate=0)
    {
        $pageCurr = isset($_POST['page'])?$_POST['page']:1;
        $prefix_url = DOMAIN.'design';
        $apiDesign = ApiDesign::index($this->limit,$pageCurr,0,1,$cate,2,0);
        if ($apiDesign['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiDesign['data']; $total = $apiDesign['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'ads'   => $this->ads(),
            'lists' => $this->list,
            'model' => $this->getModel(),
            'curr_menu' => $this->curr,
            'cate'  => $cate,
        ];
        return view('home.design.index', $result);
    }

    public function show($id)
    {
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'lists'=> $this->list,
            'data'=> $apiDesign['data'],
            'curr_menu'=> $this->curr,
            'uid'=> $apiDesign['data']['uid'],
        ];
        return view('home.design.show', $result);
    }







    public function ads()
    {
        //adplace_id==5，前台设计页面右侧，limit==2
        $apiAd = ApiAd::index(2,1,0,5,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiDesign = ApiDesign::getModel();
        return $apiDesign['code']==0 ? $apiDesign['model'] : [];
    }
}