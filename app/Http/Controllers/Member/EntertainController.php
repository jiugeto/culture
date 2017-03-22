<?php

namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiEntertain;
use App\Api\ApiBusiness\ApiGoods;
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
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/entertain';
        $apiEntertain = ApiEntertain::index($this->limit,$pageCurr,$this->userid,$this->getGenre(),2,0);
        if ($apiEntertain['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiEntertain['data']; $total = $apiEntertain['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.entertain.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'staffs' => $this->getStaffs(),
            'works' => $this->getWorks(),
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
            'works' => $this->getWorks(),
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





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $actor = $request->actor ? implode(',',$request->actor) : '';
        $work = $request->work ? implode(',',$request->work) : '';
        $entertain = [
            'title' => $request->title,
            'genre' => $this->getGenre(),
            'intro' => $request->intro,
            'uid'   => $this->userid,
            'uname' =>  Session::get('user.username'),
            'staff' =>  $actor,
            'work'  =>  $work,
        ];
        return $entertain;
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

    /**
     * 通过 uid 获取艺作品列表
     */
    public function getWorks()
    {
        $apiGoods = ApiGoods::getGoodsByUid($this->userid,4,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }
}