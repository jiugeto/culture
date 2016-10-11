<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\UserWalletModel;

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
}