<?php
namespace App\Http\Controllers\Member;

class HomeController extends BaseController
{
    /**
     * 会员后台首页
     */

    public function index()
    {
        $result = [
        ];
        return view('member.home.index', $result);
    }
}