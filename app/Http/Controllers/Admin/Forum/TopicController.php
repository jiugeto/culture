<?php
namespace App\Http\Controllers\Admin\Forum;

use App\Api\ApiTalk\ApiTopic;

class TopicController extends BaseController
{
    /**
     * 专栏
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '专栏列表';
        $this->crumb['category']['name'] = '专栏';
        $this->crumb['category']['url'] = 'topic';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/topic';
        $apiTopic = ApiTopic::index($this->limit,$pageCurr);
        if ($apiTopic['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTopic['data']; $total = $apiTopic['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.forum.topic.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.forum.topic.index', $result);
    }
}