<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiUser\ApiGold;
use App\Api\ApiUser\ApiOpinion;
use App\Api\ApiUser\ApiWallet;
use Illuminate\Http\Request;

class OpinionController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    protected $url_curr = 'opinion';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($status=0)
    {
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'opinion';
        $apiOpinion = ApiOpinion::getOpinionList($this->limit,$pageCurr,$status);
        if ($apiOpinion['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiOpinion['data']; $total = $apiOpinion['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'model' => $this->model,
            'prefix_url' => $prefix_url,
            'curr_menu' => $this->url_curr,
            'status' => $status,
        ];
        return view('home.opinion.index', $result);
    }

    public function create()
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');window.location.href='/login';</script>";
        }
        //限制用户每日发布意见的数量 <=5
        $from = strtotime(date('Ymd',time()).'000000');
        $to = strtotime(date('Ymd',time()).'235959');
        $rstOpinion = ApiOpinion::getOpinionsByTime($this->userid,$from,$to);
        if ($rstOpinion['code']==0 && count($rstOpinion['data'])>=5) {
            echo "<script>alert('今日意见发布已达上限！');history.go(-1);</script>";
        }
        $result = [
            'curr_menu'=> $this->url_curr,
            'curr'=> 'create',
        ];
        return view('home.opinion.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rstOpinion = ApiOpinion::addOpinion($data);
        if ($rstOpinion['code']!=0) {
            echo "<script>alert('".$rstOpinion['msg']."');history.go(-1);</script>";exit;
        }

        //成功发布后给用户随机奖励金币1-5个，并计算金币总数
        //金币奖励：1建议发布奖励1-5，2建议评价奖励6-10，3用户心声奖励1-5，4订单好评奖励5，
        $rstGold = ApiGold::add($this->userid,1);
        if ($rstGold['code']!=0) {
            echo "<script>alert('".$rstGold['msg']."');history.go(-1);</script>";exit;
        }

        return redirect(DOMAIN.'opinion');
    }

    public function show($id)
    {
        $this->lists['show'] = '意见详情';
        $rst = ApiOpinion::getOneOpinion($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'curr_menu'=> $this->url_curr,
            'curr'=> 'show',
        ];
        return view('home.opinion.show', $result);
    }

    public function edit($id)
    {
        if (!\Session::has('user')) {
            echo "<script>alert('未登录！');history.go(-1);</script>";
        }
        $this->lists['edit'] = '修改意见';
        $rst = ApiOpinion::getOneOpinion($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'curr_menu'=> $this->url_curr,
            'curr'=> 'edit',
        ];
        return view('home.opinion.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$id);
        $data['id'] = $id;
        $rst = ApiOpinion::modifyOpinion($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'opinion');
    }

    public function getStatus($id)
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');history.go(-1);</script>";
        }
        $this->lists['edit'] = '意见评价';
        $rst = ApiOpinion::getOneOpinion($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'curr_menu'=> $this->url_curr,
            'curr'=> 'edit',
        ];
        return view('home.opinion.status', $result);
    }

    public function setStatus(Request $request,$id)
    {
        if ($request->status==4 && !$request->remarks) {
            echo "<script>alert('请填写不满意缘由！');history.go(-1);</script>";exit;
        }
        $rstOpinion = ApiOpinion::setStatus($id,$request->status,$request->remarks);
        if ($rstOpinion['code']!=0) {
            echo "<script>alert('".$rstOpinion['msg']."');history.go(-1);</script>";exit;
        }
        //状态满意后给用户随机奖励金币10-15个
        //金币奖励：1建议发布奖励1-5，2建议评价奖励6-10，3用户心声奖励1-5，4订单好评奖励5，
        if ($request->status==4) {
            $rstGold = ApiGold::add($this->userid,2);
            if ($rstGold['code']!=0) {
                echo "<script>alert('".$rstGold['msg']."');history.go(-1);</script>";exit;
            }
        }

        return redirect(DOMAIN.'opinion');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request,$id=null)
    {
        //判断内容有无
        if (!$this->userid) {
            echo "<script>alert('未登录！');history.go(-1);</script>";exit;
        }
        if (!isset($request->intro)) {
            echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
        ];
        return $data;
    }
}