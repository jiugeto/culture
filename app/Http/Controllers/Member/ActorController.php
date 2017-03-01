<?php

namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiStaff;
use Illuminate\Http\Request;

class ActorController extends BaseController
{
    /**
     * 系统后台租赁管理
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
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'member/idea';
        $datas = $this->query($pageCurr,$genre);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $this->query($pageCurr,$genre),
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'prefix_url' => DOMAIN.'member/actor',
            'lists' => $this->lists,
            'curr' => $curr,
            'genre' => 0,
        ];
        return view('member.actor.index', $result);
    }

//    public function trash($genre=0)
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($genre,1),
//            'model'=> $this->model,
//            'prefix_url'=> DOMAIN.'member/actor/trash',
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//            'genre'=> 0,
//        ];
//        return view('member.actor.index', $result);
//    }

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
//        //插入搜索表
//        $staffModel = StaffModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($staffModel,7,'create');
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
//        //更新搜索表
//        $staffModel = StaffModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($staffModel,7,'update');
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

//    public function destroy($id)
//    {
//        StaffModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/actor');
//    }
//
//    public function restore($id)
//    {
//        StaffModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/actor/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        StaffModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/actor/trash');
//    }






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
     * 查询方法
     */
    public function query($pageCurr,$genre)
    {
        $apiActor = ApiStaff::index($this->limit,$pageCurr,$this->userid,$genre,0,2,0);
        return $apiActor['code']==0 ? $apiActor['data'] : [];
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