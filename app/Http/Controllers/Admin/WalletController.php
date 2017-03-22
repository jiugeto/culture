<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiGold;
use App\Api\ApiUser\ApiSign;
use App\Api\ApiUser\ApiTip;
use App\Api\ApiUser\ApiUsers;
use App\Api\ApiUser\ApiWallet;
use Illuminate\Http\Request;

class WalletController extends BaseController
{
    /**
     * 系统后台财务管理
     */

    protected $signByWeal = 10;     //签到兑换倍数
    protected $goldByWeal = 30;     //金币兑换倍数
    protected $tipByWeal = 1;     //红包兑换倍数

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '财务列表';
        $this->crumb['category']['name'] = '会员钱包';
        $this->crumb['category']['url'] = 'wallet';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/wallet';
        $apiWallet = ApiWallet::index($this->limit,$pageCurr);
        if ($apiWallet['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiWallet['data']; $total = $apiWallet['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
            'signByWeal' => $this->signByWeal,
            'goldByWeal' => $this->goldByWeal,
            'tipByWeal' => $this->tipByWeal,
        ];
        return view('admin.wallet.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.wallet.create', $result);
    }

    public function store(Request $request)
    {
        $rstUser = ApiUsers::getOneUserByUname($request->username);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        $rstWallet = ApiWallet::getWalletByUid($rstUser['data']['id']);
        if ($rstWallet['code']==0) {
            echo "<script>alert('该用户已有钱包！');history.go(-1);</script>";exit;
        }
        if ($rstWallet['code']!=0&&$rstWallet['msg']=='没有数据！') {
            $data = [
                'uid'   =>  $rstUser['data']['id'],
                'sign'  =>  0,
                'gold'  =>  0,
                'tip'   =>  0,
            ];
            $rstWallet2 = ApiWallet::add($data);
            if ($rstWallet2['code']==0) {
                echo "<script>alert('".$rstWallet2['msg']."');history.go(-1);</script>";exit;
            }
        }
        return redirect(DOMAIN.'admin/wallet');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiWallet::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.wallet.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'id'    =>  $id,
            'uid'   =>  $request->uid,
            'sign'  =>  $request->sign,
            'gold'  =>  $request->gold,
            'tip'   =>  $request->tip,
            'weal'  =>  $request->weal,
        ];
        $rst = ApiWallet::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/wallet');
    }

    /**
     * 签到列表
     */
    public function signList()
    {
        $curr['name'] = '签到列表';
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/sign';
        $apiSign = ApiSign::index($this->limit,$pageCurr,0);
        if ($apiSign['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiSign['data']; $total = $apiSign['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.wallet.signList', $result);
    }

    /**
     * 金币列表
     */
    public function goldList()
    {
        $curr['name'] = '金币列表';
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/gold';
        $apiGold = ApiGold::index($this->limit,$pageCurr,0);
        if ($apiGold['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiGold['data']; $total = $apiGold['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.wallet.goldList', $result);
    }

    /**
     * 红包列表
     */
    public function tipList()
    {
        $curr['name'] = '红包列表';
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/tip';
        $apiTip = ApiTip::index($this->limit,$pageCurr);
        if ($apiTip['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTip['data']; $total = $apiTip['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.wallet.tipList', $result);
    }

    /**
     * 签到兑换福利：t==1sign、2gold、3tip
     */
    public function getWeal($id,$type)
    {
        $curr['name'] = '兑换福利';
        $curr['url'] = $this->crumb['edit']['url'];
        $apiWallet = ApiWallet::show($id);
        if ($apiWallet['code']!=0) {
            echo "<script>alert('".$apiWallet['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiWallet['data'],
            'crumb' => $this->crumb,
            'curr' => $curr,
            'type' => $type,
            'signByWeal' => $this->signByWeal,
            'goldByWeal' => $this->goldByWeal,
            'tipByWeal' => $this->tipByWeal,
        ];
        return view('admin.wallet.editWeal', $result);
    }

    /**
     * 兑换更新福利
     */
    public function setWeal(Request $request,$id)
    {
        if (!$request->num) { echo "<script>alert('数量必填！');history.go(-1);</script>";exit; }
        $apiWallet = ApiWallet::updateWeal($request->uid,$request->type,$request->num);
        if ($apiWallet['code']!=0) {
            echo "<script>alert('".$apiWallet['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/wallet');
    }
}