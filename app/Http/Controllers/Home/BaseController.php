<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\LinkModel;
use App\Tools;

class BaseController extends Controller
{
    /**
     * 前台页面基础控制器
     */

    /**
     * header头部 页面数据
     */
    public function header()
    {
        $headers = [];
        $headers = LinkModel::where('type_id',1)->get();
        return $headers;
    }

    /**
     * navigate菜单导航栏 页面数据
     */
    public function navigate()
    {
        $navigates = [];
        $navigates = LinkModel::where('type_id',2)->get();
        return $navigates;
    }

    /**
     * footer脚部 页面数据
     */
    public function footer()
    {
        $footers = [];
        $footers = LinkModel::where('type_id',3)->get();
        return $footers;
    }
}