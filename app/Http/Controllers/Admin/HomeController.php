<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;

class HomeController extends BaseController
{
    /**
     * 系统后台首页
     */

    public function index()
    {
        return view('admin.home');
    }
}