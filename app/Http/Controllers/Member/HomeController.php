<?php
namespace App\Http\Controllers\Member;

class HomeController extends BaseController
{
    /**
     * 会员后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '账户首页';
        $this->list['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'menus'=> $this->list,
        ];
        return view('member.home.index', $result);
    }
}