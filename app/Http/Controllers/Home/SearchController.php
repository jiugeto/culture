<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiSearch;
use Redis;

class SearchController extends BaseController
{
    /**
     * 前台搜索
     */

    protected $limit = 20;  //每页显示20条记录

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=1,$keyword='')
    {
        /**
         * genre：
         * 1视频动画（产品），2故事（脚本），3设备（租赁），4人员（演员等），
         * 5配音，6设计，7投放（视频），8花絮
         */
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'s/'.$genre.'/'.$keyword;
        if ($keyword) {
            $apiSearch = ApiSearch::index($this->limit,$pageCurr,$genre,$keyword);
        }
        if (!isset($apiSearch) || (isset($apiSearch['code'])&&$apiSearch['code']!=0)) {
            $sesrchs = array(); $total = 0;
        } else {
            $sesrchs = $apiSearch['data']; $total = $apiSearch['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        dd($sesrchs);
        $result = [
            'searchs' => $sesrchs,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'searchGenre' => $genre,
            'keyword' => $keyword,
        ];
        return view('home.search.index', $result);
    }

    /**
     * 初始化搜索表
     */
    public function init()
    {
    }
}