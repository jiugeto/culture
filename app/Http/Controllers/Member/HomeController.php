<?php
namespace App\Http\Controllers\Member;

class HomeController extends BaseController
{
    /**
     * 会员后台首页
     */

    public function __construct()
    {
        $this->lists['func']['name'] = '账户首页';
        $this->lists['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->lists,
            'curr_list'=> 'member',
            'menus'=> $this->menus,
        ];
        return view('member.home.index', $result);
    }
}