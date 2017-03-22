<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    /**
     * 会员后台租赁供求管理
     * rent 器材租赁
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '租赁管理';
        $this->lists['func']['url'] = 'rent';
        $this->lists['create']['name'] = '租赁发布';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if (!$type) {
            $prefix_url = DOMAIN.'member/rent';
        } else {
            $prefix_url = DOMAIN.'member/rent/s/'.$type;
        }
        $apiRent = ApiRent::index($this->limit,$pageCurr,$this->userid,$this->getGenre(),$type,2,0);
        if ($apiRent['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiRent['data']; $total = $apiRent['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'type' => $type,
        ];
        return view('member.rent.index', $result);
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
        return view('member.rent.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiRent = ApiRent::add($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/rent');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiRent['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.rent.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiRent = ApiRent::modify($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/rent');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiRent['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.rent.show', $result);
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //日期验证
        if (!$request->from_y && !$request->from_m && !$request->from_d) { $from = 0; }
        if (!$request->to_y && !$request->to_m && !$request->to_d) { $to = 0; }
        if ($request->from_y) {
            if (!$request->from_m || !$request->from_d) {
                echo "<script>alert('起始日期格式有误！');history.go(-1);</script>";exit;
            }
            $from = $request->from_y.'-'.$request->from_m.'-'.$request->from_d;
        }
        if ($request->to_y) {
            if (!$request->to_m || !$request->to_d) {
                echo "<script>alert('结束日期格式有误！');history.go(-1);</script>";exit;
            }
            $to = $request->to_y.'-'.$request->to_m.'-'.$request->to_d;
        }
        $fromtime = (isset($from)&&$from) ? strtotime($from) : 0;
        $totime = (isset($to)&&$to) ? strtotime($to) : 0;
        if ((!$fromtime&&$totime) || ($fromtime&&!$totime)) {
            echo "<script>alert('起始、结束时间须同时选择！');history.go(-1);</script>";exit;
        } else if ($fromtime > $totime) {
            echo "<script>alert('结束时间不能早于起始时间！');history.go(-1);</script>";exit;
        }
        //获取用户信息
        $apiUser = ApiUsers::getOneUser($this->userid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('用户不存在！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  =>  $request->name,
            'genre' =>  $this->getGenre(),
            'type'  =>  $request->type,
            'intro' =>  $request->intro,
            'uid'   =>  $this->userid,
            'money' =>  $request->money,
            'fromtime'  =>  $fromtime,
            'totime'    =>  $totime,
            'area'      =>  $apiUser['data']['area'],
        ];
        return $data;
    }


    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiRent::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 判断用户类型
     */
    public function getGenre()
    {
        $apiUser = ApiUsers::getOneUser($this->userid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        if ($apiUser['data']['isuser']==7) {
            $genre = 1;     //租赁供应
        } else {
            $genre = 2;     //租赁需求
        }
        return $genre;
    }
}