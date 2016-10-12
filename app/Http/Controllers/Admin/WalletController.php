<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\UserSignModel;
use App\Models\Base\UserTipModel;
use App\Models\Base\UserWalletModel;
use App\Models\OpinionModel;
use Illuminate\Http\Request;

class WalletController extends BaseController
{
    /**
     * 系统后台财务管理
     */

    protected $signByWeal = 30;     //签到兑换倍数
    protected $goldByWeal = 10;     //金币兑换倍数
    protected $tipByWeal = 1;     //红包兑换倍数

    public function __construct()
    {
        parent::__construct();
        $this->model = new UserWalletModel();
        $this->crumb['']['name'] = '财务列表';
        $this->crumb['category']['name'] = '会员钱包';
        $this->crumb['category']['url'] = 'wallet';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/wallet',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.wallet.index', $result);
    }

    /**
     * 签到列表
     */
    public function signList()
    {
        $curr['name'] = '签到列表';
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->getSigns(),
            'prefix_url'=> DOMAIN.'admin/sign',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $result = [
            'datas'=> $this->getGolds(),
            'prefix_url'=> DOMAIN.'admin/gold',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $result = [
            'datas'=> $this->getTips(),
            'prefix_url'=> DOMAIN.'admin/tip',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $result = [
            'data'=> UserWalletModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'type'=> $type,
            'signByWeal'=> $this->signByWeal,
            'goldByWeal'=> $this->goldByWeal,
            'tipByWeal'=> $this->tipByWeal,
        ];
        return view('admin.wallet.editWeal', $result);
    }

    /**
     * 兑换更新福利
     */
    public function setWeal(Request $request,$id)
    {
        if (!$request->num) { echo "<script>alert('数量必填！');history.go(-1);</script>";exit; }
        $wallet = UserWalletModel::find($id);
        if ($request->type==1) {
            $signCount = $request->num * $this->signByWeal;
            $data = [
                'sign'=> $wallet->sign - $signCount,
                'weal'=> $wallet->weal + $request->num,
            ];
        } else if ($request->type==2) {
            $goldCount = $request->num * $this->goldByWeal;
            $data = [
                'gold'=> $wallet->gold - $goldCount,
                'weal'=> $wallet->weal + $request->num,
            ];
        } else if ($request->type==3) {
            $tipCount = $request->num * $this->tipByWeal;
            $data = [
                'tip'=> $wallet->tip - $tipCount,
                'weal'=> $wallet->weal + $request->num,
            ];
        }
        UserWalletModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/wallet');
    }






    public function query()
    {
        $datas = UserWalletModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        $datas->signByWeal = $this->signByWeal;
        $datas->goldByWeal = $this->goldByWeal;
        $datas->tipByWeal = $this->tipByWeal;
        return $datas;
    }

    public function getSigns()
    {
        $datas = UserSignModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getGolds()
    {
        $datas = OpinionModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getTips()
    {
        $datas = UserTipModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}