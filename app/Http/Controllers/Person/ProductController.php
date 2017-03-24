<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiOnline\ApiProduct;

class ProductController extends BaseController
{
    /**
     * 个人后台 视频列表，在线创作的
     */

    protected $curr = 'product';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'person/product';
        $apiProduct = ApiProduct::getProductsList($this->limit,$pageCurr,$this->userid,0,2);
        if ($apiProduct['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiProduct['data']; $total = $apiProduct['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url'=> $prefix_url,
            'curr' => $this->curr,
        ];
        return view('person.product.index', $result);
    }
}