<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiDesign;

class DesignController extends BaseController
{
    /**
     * 个人后台 设计管理
     */

    protected $curr = 'design';
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'person/design';
        $apiDesign = ApiDesign::index($this->limit,$pageCurr,$this->userid,0,0,2,0);
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
            'curr' => $this->curr,
        ];
        return view('person.design.index', $result);
    }
}