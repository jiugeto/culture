<?php
namespace App\Http\Controllers\Admin;

use App\Models\AdModel;

class AdController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '广告列表';
        $this->crumb['category']['name'] = '广告管理';
        $this->crumb['category']['url'] = 'ad';
    }

    public function index()
    {
        $datas = AdModel::where('del',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $datas,
            'prefix_url'=> '/admin/ad',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.ad.index', $result);
    }

    public function create(){}
}