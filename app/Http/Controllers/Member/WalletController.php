<?php
namespace App\Http\Controllers\Member;

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
}