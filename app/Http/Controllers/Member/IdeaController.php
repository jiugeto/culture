<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiIdea;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 会员后台创意管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '故事管理';
        $this->lists['func']['url'] = 'idea';
        $this->lists['create']['name'] = '新的故事';
    }

    public function index($genre=1,$cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/idea';
        $apiIdea = ApiIdea::index($this->limit,$pageCurr,$this->userid,$genre,$cate,2,0);
        if ($apiIdea['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiIdea['data']; $total = $apiIdea['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'genre' => $genre,
        ];
        return view('member.idea.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiIdea = ApiIdea::add($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/idea');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiIdea['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiIdea = ApiIdea::modify($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/idea');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiIdea['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.show', $result);
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro) {
            echo "<script>alert('内容简介不能为空！');history.go(-1);</script>";exit;
        }
        if (!$request->detail) {
            echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
            'money' =>  $request->money,
        ];
        return $data;
    }


    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiIdea::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}