<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ActionModel;

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
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $this->actions(),
        ];
        return view('admin.ad.index', $result);
    }
}