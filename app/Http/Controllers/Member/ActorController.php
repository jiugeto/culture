<?php

namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiStaff;
use Illuminate\Http\Request;

class ActorController extends BaseController
{
    /**
     * 艺人管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '艺人管理';
        $this->lists['func']['url'] = 'actor';
        $this->lists['create']['name'] = '添加艺人';
    }

    public function index($genre=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if (!$genre) {
            $prefix_url = DOMAIN.'member/actor';
        } else {
            $prefix_url = DOMAIN.'member/actor/s/'.$genre;
        }
        $apiActor = ApiStaff::index($this->limit,$pageCurr,$this->userid,$genre,0,2,0);
        if ($apiActor['code']!==0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiActor['data']; $total = $apiActor['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'genre' => 0,
        ];
        return view('member.actor.index', $result);
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
        return view('member.actor.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiActor = ApiStaff::add($data);
        if ($apiActor['code']!=0) {
            echo "<script>alert('".$apiActor['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/actor');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiActor = ApiStaff::show($id);
        if ($apiActor['code']!=0) {
            echo "<script>alert('".$apiActor['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiActor['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.actor.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiActor = ApiStaff::modify($data);
        if ($apiActor['code']!=0) {
            echo "<script>alert('".$apiActor['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/actor');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiActor = ApiStaff::show($id);
        if ($apiActor['code']!=0) {
            echo "<script>alert('".$apiActor['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiActor['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.actor.show', $result);
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->hobby) { echo "<script>alert('请填写兴趣！');history.go(-1);</script>";exit; }
        $data = [
            'name'  => $request->name,
            'sex'   => $request->sex,
            'realname'  => $request->realname,
            'origin'    => $request->origin,
            'edu'       => $request->edu,
            'school'    => $request->school,
            'hobby'     => implode(',',$request->hobby),
            'height'    => $request->height,
            'type'      => 1,    //1代表演员
            'uid'       => $this->userid,
        ];
        return $data;
    }


    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiStaff::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}