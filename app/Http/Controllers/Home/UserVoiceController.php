<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiUser\ApiGold;
use App\Api\ApiUser\ApiUserVoice;
use App\Api\ApiUser\ApiWallet;
use Illuminate\Http\Request;

class UserVoiceController extends BaseController
{
    /**
     * 前台用户心声管理
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'uservoice';
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
        ];
        return view('home.uservoice.index', $result);
    }

    public function create()
    {
        if (!$this->userid) {
            echo "<script>alert('请先登录！');history.go(-1);</script>";exit;
        }
        return view('home.uservoice.create');
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiUserVoice::add($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }

        //成功发布后给用户随机奖励金币1-5个
        //金币奖励：1建议发布奖励1-5，2建议评价奖励6-10，3用户心声奖励1-5，4订单好评奖励5，
        $rstGold = ApiGold::add($this->userid,3);
        if ($rstGold['code']!=0) {
            echo "<script>alert('".$rstGold['msg']."');history.go(-1);</script>";exit;
        }

        return redirect(DOMAIN.'uservoice');
    }

    public function show($id)
    {
        $rst = ApiUserVoice::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
        ];
        return view('home.uservoice.show', $result);
    }






    public function getData(Request $request)
    {
        return array(
            'uid'=> $this->userid,
            'name'=> $request->name,
            'work'=> $request->work,
            'intro'=> $request->intro,
        );
    }

    public function query($pageCurr)
    {
        $rst = ApiUserVoice::getUserVoiceList($this->limit,$pageCurr);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        return $datas;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiUserVoice::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}