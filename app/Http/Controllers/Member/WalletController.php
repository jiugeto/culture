<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiGold;
use App\Api\ApiUser\ApiSign;
use App\Api\ApiUser\ApiTip;
use App\Api\ApiUser\ApiWallet;

class WalletController extends BaseController
{
    /**
     * 会员后台 钱袋管理
     */

    protected $signByWeal = 10;     //签到兑换倍数
    protected $goldByWeal = 30;     //金币兑换倍数
    protected $tipByWeal = 1;     //红包兑换倍数

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '会员福利';
        $this->lists['func']['url'] = 'wallet';
    }

    public function index()
    {
        $curr['name'] = '福利中心';
        $curr['url'] = $this->lists['']['url'];
        $data = $this->query();
        $data['signByWeal'] = $this->signByWeal;
        $data['goldByWeal'] = $this->goldByWeal;
        $data['tipByWeal'] = $this->tipByWeal;
        $result = [
            'data'=> $data,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.index', $result);
    }

    /**
     * 福利签到列表
     */
    public function signList()
    {
        $curr['name'] = '福利中心 - 签到记录';
        $curr['url'] = $this->lists['']['url'];
        $prefix_url = DOMAIN.'member/sign';
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $datas = $this->getSigns($pageCurr,$prefix_url);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.wallet.signList', $result);
    }

    /**
     * 福利金币列表
     */
    public function goldList()
    {
        $curr['name'] = '福利中心 - 金币记录';
        $curr['url'] = $this->lists['']['url'];
        $prefix_url = DOMAIN.'member/gold';
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $datas = $this->getGolds($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.wallet.goldList', $result);
    }

    /**
     * 福利红包列表
     */
    public function tipList()
    {
        $curr['name'] = '福利中心 - 红包记录';
        $curr['url'] = $this->lists['']['url'];
        $prefix_url = DOMAIN.'member/tip';
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $datas = $this->getTips($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.tipList', $result);
    }

    /**
     * 通过签到兑换福利
     */
    public function setWealBySign($sign)
    {
        $apiWallet = ApiWallet::updateWeal($this->userid,1,$sign);
        if ($apiWallet['code']!=0) {
            echo "<script>alert('".$apiWallet['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 通过金币兑换福利
     */
    public function setWealByGold($gold)
    {
        $apiWallet = ApiWallet::updateWeal($this->userid,2,$gold);
        if ($apiWallet['code']!=0) {
            echo "<script>alert('".$apiWallet['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 通过红包兑换福利
     */
    public function setWealByTip($tip)
    {
        $apiWallet = ApiWallet::updateWeal($this->userid,3,$tip);
        if ($apiWallet['code']!=0) {
            echo "<script>alert('".$apiWallet['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 在前台获取红包：红包类型、额度
     */
    public function setTip($type,$tip)
    {
//        $tipModel = UserTipModel::where('uid',$this->userid)
//            ->where('type',$type)
//            ->where('tip',$tip)
//            ->first();
//        if ($tipModel) {
//            echo "<script>alert('已领过此红包！');window.location.href='".DOMAIN."member/wallet';</script>";exit;
//        }
//        $data = [
//            'uid'=> $this->userid,
//            'type'=> $type,
//            'tip'=> $tip,
//            'created_at'=> time(),
//        ];
//        UserTipModel::create($data);
//        //更新用户钱袋的红包
//        $wallet = WalletModel::where('uid',$this->userid)->first();
//        WalletModel::where('uid',$this->userid)->update(['tip'=> $wallet->tip+$tip]);
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 通过 uid 获取兑换记录
     */
    public function getToWeal()
    {
        $curr['name'] = '福利中心 - 福利兑换记录';
        $curr['url'] = $this->lists['']['url'];
        $apiWallet = ApiWallet::getConvertRecord($this->userid);
        $prefix_url = DOMAIN.'member/wallet/toweal';
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $datas = $apiWallet['code']==0 ? $apiWallet['data'] : [];
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.convertList', $result);
    }






    public function query()
    {
        $apiWallet = ApiWallet::getWalletByUid($this->userid);
        return $apiWallet['code']==0 ? $apiWallet['data'] : [];
    }

    /**
     * 签到查询
     */
    public function getSigns($pageCurr)
    {
        $rst = ApiSign::index($this->limit,$pageCurr,$this->userid);
        return $rst['code']==0 ? $rst['data'] : [];
    }

    /**
     * 金币查询
     */
    public function getGolds($pageCurr)
    {
        $rst = ApiGold::index($this->limit,$pageCurr,$this->userid);
        return $rst['code']==0 ? $rst['data'] : [];
    }

    /**
     * 红包查询
     */
    public function getTips($pageCurr)
    {
        $rst = ApiTip::index($this->limit,$pageCurr,$this->userid);
        return $rst['code']==0 ? $rst['data'] : [];
    }
}