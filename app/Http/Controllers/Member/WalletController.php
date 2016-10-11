<?php
namespace App\Http\Controllers\Member;

use App\Models\Base\UserTipModel;
use App\Models\Base\UserWalletModel;

class WalletController extends BaseController
{
    /**
     * 会员后台 钱袋管理
     */

    protected $signByWeal = 30;     //签到兑换倍数

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
            'tips'=> $this->getTips(),
            'prefix_url'=> DOMAIN.'member/wallet',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.index', $result);
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
     * 福利红包列表
     */
    public function tipList()
    {
        $curr['name'] = '福利中心';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->getTips(),
            'prefix_url'=> DOMAIN.'member/wallet/tip',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.wallet.tipList', $result);
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
        return redirect(DOMAIN.'member/wallet');
    }

    /**
     * 红包兑换福利额度
     */
    public function setTipToWeal($tip_id)
    {
        $tipModel = UserTipModel::find($tip_id);
        $walletModel = UserWalletModel::where('uid',$this->userid)->first();
        UserWalletModel::where('uid',$this->userid)->update(['tip'=> $walletModel->tip+$tipModel->tip]);
        UserTipModel::where('id',$tip_id)->update(['is_use'=> 2, 'updated_at'=> time()]);
        return redirect(DOMAIN.'member/wallet/tip');
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
        return $data1;
    }

    public function getTips()
    {
        $datas = UserTipModel::where('uid',$this->userid)
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}