<?php
namespace App\Http\Controllers\Home;

class RentController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    public function index($genre=0)
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'rent',
            'genre'=> $genre,
        ];
        return view('home.rent.index', $result);
    }
}