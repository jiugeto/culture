<?php
namespace App\Http\Controllers\Home;

class AboutController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'about';

    public function index()
    {
        $result = [
            'curr_menu'=> $this->curr,
        ];
        return view('home.about.index', $result);
    }

    /**
     * 招募伙伴
     */
    public function join()
    {
        $result = [
            'curr_menu'=> $this->curr,
        ];
        return view('home.about.join', $result);
    }
}