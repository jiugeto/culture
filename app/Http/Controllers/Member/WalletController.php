<?php
namespace App\Http\Controllers\Member;

use App\Models\Base\UserTipModel;
use App\Models\Base\UserWalletModel;
use App\Models\OpinionModel;

class WalletController extends BaseController
{
    /**
     * 会员后台 钱袋管理
     */

    protected $signByWeal = 30;     //签到兑换倍数
    protected $goldByWeal = 10;     //金币兑换倍数
    protected $tipByWeal = 1;     //红包兑换倍数

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '会员福利';
        $this->lists['func']['url'] = 'wallet';
        $this->model = new UserWalletModel();
    }

    public function index()
    {
        $curr['name'] = '福利中心';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'data'=> $this->query(),
            'golds'=> $this->getGolds(0),
            'tips'=> $this->getTips(),
            'prefix_url'=> DOMAIN.'member/wallet',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.index', $result);
    }

    /**
     * 福利金币列表
     */
    public function goldList()
    {
        $curr['name'] = '福利中心';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->getGolds(0),
            'prefix_url'=> DOMAIN.'member/gold',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.goldList', $result);
    }

    /**
     * 福利红包列表
     */
    public function tipList()
    {
        $curr['name'] = '福利中心';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->getTips(),
            'prefix_url'=> DOMAIN.'member/tip',
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
        $wallet = UserWalletModel::where('uid',$this->userid)->first();
        if ($sign>$wallet->sign) {
            echo "<script>alert('签到不足！');history.go(-1);</script>";exit;
        }
        $data = [
            'sign'=> $wallet->sign-$sign,
            'weal'=> $wallet->weal+$sign/$this->signByWeal,
            'updated_at'=> time(),
        ];
        UserWalletModel::where('uid',$this->userid)->update($data);
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 通过金币兑换福利
     */
    public function setWealByGold($gold)
    {
        $wallet = UserWalletModel::where('uid',$this->userid)->first();
        if ($gold>$wallet->gold) {
            echo "<script>alert('金币不足！');history.go(-1);</script>";exit;
        }
        $data = [
            'gold'=> $wallet->gold-$gold,
            'weal'=> $wallet->weal+$gold/$this->goldByWeal,
            'updated_at'=> time(),
        ];
        UserWalletModel::where('uid',$this->userid)->update($data);
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 在前台获取红包：红包类型、额度
     */
    public function setTip($type,$tip)
    {
        $tipModel = UserTipModel::where('uid',$this->userid)
            ->where('type',$type)
            ->where('tip',$tip)
            ->first();
        if ($tipModel) {
            echo "<script>alert('已领过此红包！');window.location.href='".DOMAIN."member/wallet';</script>";exit;
        }
        $data = [
            'uid'=> $this->userid,
            'type'=> $type,
            'tip'=> $tip,
            'created_at'=> time(),
        ];
        UserTipModel::create($data);
        //更新用户钱袋的红包
        $wallet = UserWalletModel::where('uid',$this->userid)->first();
        UserWalletModel::where('uid',$this->userid)->update(['tip'=> $wallet->tip+$tip]);
        return redirect(DOMAIN.'member/wallet');
    }






    public function query()
    {
        if (!UserWalletModel::where('uid',$this->userid)->first()) {
            $data = [
                'uid'=> $this->userid,
                'weal'=> 200,
                'created_at'=> time(),
            ];
            UserWalletModel::create($data);
        }
        $data1 = UserWalletModel::where('uid',$this->userid)->first();
        $data1->signByWeal = $this->signByWeal;
        $data1->goldByWeal = $this->goldByWeal;
        $data1->tipByWeal = $this->tipByWeal;
        return $data1;
    }

    /**
     * 金币查询
     */
    public function getGolds($status)
    {
        if ($status==4) {
            $datas = OpinionModel::where('uid',$this->userid)
                ->where('status',4)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = OpinionModel::where('uid',$this->userid)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 红包查询
     */
    public function getTips()
    {
        $datas = UserTipModel::where('uid',$this->userid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}