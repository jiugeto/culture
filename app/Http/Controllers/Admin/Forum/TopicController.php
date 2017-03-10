<?php
namespace App\Http\Controllers\Admin\Forum;

use App\Api\ApiTalk\ApiTopic;
use Illuminate\Http\Request;

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
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.forum.topic.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiTopic = ApiTopic::add($data);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/topic');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiTopic = ApiTopic::show($id);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiTopic['data'],
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.forum.topic.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $data['sort'] = $request->sort;
        $apiTopic = ApiTopic::modify($data);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/topic');
    }





    public function getData(Request $request)
    {
        return array(
            'name'  =>  $request->name,
            'intro' =>  $request->intro,
        );
    }
}