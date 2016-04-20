<?php
namespace App\Http\Controllers\Home;

class HomeController extends BaseController
{
    /**
     * 网站首页
     */

    public function __construct()
    {
    }

    public function index()
    {
        $result = [
            'ideas'=> $this->getIdeas(),
            'talks'=> $this->getTalks(),
//            'menus'=> $this->menus,
            'curr_menu'=> '/',
            'number'=> $this->number,
            'floors'=> $this->floors,
        ];
        return view('home.home.index', $result);
    }

    public function getIdeas()
    {
        return \App\Models\IdeasModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
//                    ->paginate($this->limit);
    }

    public function getTalks()
    {
        return \App\Models\TalksModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
//                    ->paginate($this->limit);
    }
}