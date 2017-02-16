<?php

namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiEntertain;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use Session;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '娱乐管理';
        $this->lists['func']['url'] = 'entertain';
        $this->lists['create']['name'] = '娱乐发布';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/entertain';
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.entertain.index', $result);
    }

//    public function trash($genre=0)
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=1,$this->genre),
//            'prefix_url'=> DOMAIN.'member/entertain',
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//            'genre'=> $genre,
//        ];
//        return view('member.entertain.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'staffs' => $this->getStaffs(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.entertain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiEntertain = ApiEntertain::add($data);
        if ($apiEntertain['code']!=0) {
            echo "<script>alert('".$apiEntertain['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/entertain');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiEntertain = ApiEntertain::show($id);
        if ($apiEntertain['code']!=0) {
            echo "<script>alert('".$apiEntertain['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiEntertain['data'],
            'staffs' => $this->getStaffs(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiEntertain = ApiEntertain::modify($data);
        if ($apiEntertain['code']!=0) {
            echo "<script>alert('".$apiEntertain['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/entertain');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiEntertain = ApiEntertain::show($id);
        if ($apiEntertain['code']!=0) {
            echo "<script>alert('".$apiEntertain['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiEntertain['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.show', $result);
    }

//    public function destroy($id)
//    {
//        EntertainModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/entertain');
//    }
//
//    public function restore($id)
//    {
//        EntertainModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/entertain/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        EntertainModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/entertain/trash');
//    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->actor) {
            echo "<script>alert('演员必选！');history.go(-1);</script>";exit;
        }
        $entertain = [
            'title' => $request->title,
            'genre' => $this->getGenre(),
            'intro' => $request->intro,
            'uid'   => $this->userid,
            'uname' =>  Session::get('user.username'),
            'staff'    =>  implode(',',$request->actor),
        ];
        return $entertain;
    }

    /**
     * 查询方法
     */
    public function query($pageCurr)
    {
        $uid = $this->userType==50 ? 0 : $this->userid;
        $genre = $this->userType==50 ? 0 : $this->getGenre();
        $apiEntertain = ApiEntertain::index($this->limit,$pageCurr,$uid,$genre,2,0);
        return $apiEntertain['code']==0 ? $apiEntertain['data'] : [];
    }

    /**
     * 判断用户类型
     */
    public function getGenre()
    {
        if ($this->userType==6) {
            //影视公司
            $genre = 1;       //供应
        } else {
            //普通企业、广告公司、租赁公司、超级用户
            $genre = 2;       //需求
        }
        return isset($genre) ? $genre : 0;
    }

    /**
     * 通过 uid 获取艺人列表
     */
    public function getStaffs()
    {
        $apiStaffs = ApiStaff::getStaffsByUid($this->userid,0,1);
        return $apiStaffs['code']==0 ? $apiStaffs['data'] : [];
    }
}