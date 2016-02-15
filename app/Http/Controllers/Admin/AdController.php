<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ActionModel;
use App\Models\AdModel;
use App\Models\AdPlaceModel;

class AdController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '广告管理',
            'url'=> 'ad',
        ],
    ];

    public function index()
    {
        $datas = AdModel::where('del',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '广告列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $datas,
            'crumb'=> $crumb,
            'prefix_url'=> '/admin/ad',
        ];
        return view('admin.ad.index', $result);
    }

    public function create(){}
}