<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiGoodsCus;
use App\Api\ApiBusiness\ApiGoodsCusUsers;
use Illuminate\Http\Request;

class GoodsCusController extends BaseController
{
    /**
     * 会员后台片源定制
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '片源定制';
        $this->lists['func']['url'] = 'goodscus';
        $this->lists['create']['name'] = '添加片源';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/procus';
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.goodscus.index', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiGoodsCus = ApiGoodsCus::add($data);
        if ($apiGoodsCus['code']!=0) {
            echo "<script>alert('".$apiGoodsCus['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/goodscus');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiGoodsCus = ApiGoodsCus::show($id);
        if ($apiGoodsCus['code']!=0) {
            echo "<script>alert('".$apiGoodsCus['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiGoodsCus['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goodscus.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiGoodsCus = ApiGoodsCus::modify($data);
        if ($apiGoodsCus['code']!=0) {
            echo "<script>alert('".$apiGoodsCus['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/goodscus');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiGoodsCus = ApiGoodsCus::show($id);
        if ($apiGoodsCus['code']!=0) {
            echo "<script>alert('".$apiGoodsCus['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiGoodsCus['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goodscus.show', $result);
    }

    /**
     * 用户竞价列表
     */
    public function getCusList($id)
    {
        $curr['name'] = '供应列表';
        $curr['url'] = $this->lists['']['url'].'/cuslist/'.$id;
        $apiGoodsCus = ApiGoodsCus::show($id);
        if ($apiGoodsCus['code']!=0) {
            echo "<script>alert('".$apiGoodsCus['msg']."');history.go(-1);</script>";exit;
        }
        //获取竞价用户列表
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/goodscus/cuslist';
        $apiGoodsCusUser = ApiGoodsCusUsers::index($this->limit,$pageCurr,$id,0);
        $userList = $apiGoodsCusUser['code']==0 ? $apiGoodsCusUser['data'] : [];
        $pagelist = $this->getPageList($userList,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'goodsCus' => $apiGoodsCus['data'],
            'userList' => $userList,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
//            'zspChat' => 1,      //调用聊天窗口
        ];
        return view('member.goodscus.cusList', $result);
    }

    /**
     * 竞价用户添加
     */
    public function addCusUser(Request $request,$id){}





    public function getData(Request $request)
    {
        return array(
            'name'  =>  $request->name,
            'intro' =>  $request->intro,
            'money' =>  $request->money,
            'uid'   =>  $this->userid,
        );
    }

    public function query($pageCurr)
    {
        $uid = $this->userType==50 ? 0 : $this->userid;
        $apiGoodsCus = ApiGoodsCus::index($this->limit,$pageCurr,$uid,0);
        return $apiGoodsCus['code']==0 ? $apiGoodsCus['data'] : [];
    }
}