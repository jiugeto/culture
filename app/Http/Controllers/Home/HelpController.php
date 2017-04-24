<?php
namespace App\Http\Controllers\Home;

class HelpController extends BaseController
{
    /**
     * 用户帮助中心
     */

    public function index()
    {
        $result = [
            'curr_menu'=> 'help',
        ];
        return view('home.help.index', $result);
    }
}