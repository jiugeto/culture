<?php
namespace App\Http\Controllers\Admin\Forum;

use App\Api\ApiTalk\ApiCate;
use App\Api\ApiTalk\ApiTopic;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class CateController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '类别列表';
        $this->crumb['category']['name'] = '类别';
        $this->crumb['category']['url'] = 'cate';
    }

    public function index($topic=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/cate';
        $apiCate = ApiCate::index($this->limit,$pageCurr,$topic,0);
        if ($apiCate['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiCate['data']; $total = $apiCate['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'topics' => $this->getTopicAll(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'topic' => $topic,
        ];
        return view('admin.forum.cate.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'cates' => $this->getParent(0),
            'topics' => $this->getTopicAll(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.forum.cate.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiCate = ApiCate::add($data);
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/cate');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiCate = ApiCate::show($id);
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiCate['data'],
            'cates' => $this->getParent(0),
            'topics' => $this->getTopicAll(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.forum.cate.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiCate = ApiCate::modify($data);
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/cate');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiCate = ApiCate::show($id);
        if ($apiCate['code']!=0) {
            echo "<script>alert('".$apiCate['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiCate['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.forum.cate.show', $result);
    }





    public function getData(Request $request)
    {
        if ($request->pid!=0) {
            $apiTopic = ApiTopic::show($request->pid);
            if ($apiTopic['code']!=0) {
                echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
            }
            $topic_id = $apiTopic['data']['id'];
        } else {
            $topic_id = $request->topic_id;
        }
        return array(
            'name'  =>  $request->name,
            'intro' =>  $request->intro,
            'pid'   =>  $request->pid,
            'topic_id'  =>  $topic_id,
        );
    }

    public function getParent($pid=0)
    {
        $apiCate = ApiCate::getCatesByPid($pid);
        return $apiCate['code']==0 ? $apiCate['data'] : [];
    }

    /**
     * 获取所有专栏
     */
    public function getTopicAll()
    {
        $apiTopic = ApiTopic::all();
        return $apiTopic['code']==0 ? $apiTopic['data'] : [];
    }
}