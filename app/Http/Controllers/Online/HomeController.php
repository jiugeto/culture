<?php
namespace App\Http\Controllers\Online;

class HomeController extends BaseController
{
    /**
     * 在线创作窗口主页
     */

    public function index()
    {
        return view('online.home.index');
    }
}