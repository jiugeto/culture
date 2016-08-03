<?php
namespace App\Http\Controllers\Home;

use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 网站前台娱乐频道
     */

    public function index($genre0=1,$genre=1)
    {
        $result = [
            'datas'=> $this->query($genre0,$genre),
            'curr_menu'=> 'entertain',
            'genre0'=> $genre0,
        ];
        return view('home.entertain.index', $result);
    }





    public function query($genre0,$genre)
    {
        if ($genre0==1) {
            //只显示供应的
            $datas = EntertainModel::where('genre',1)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre0==2) {
            $datas = '';
        }
        return $datas;
    }
}