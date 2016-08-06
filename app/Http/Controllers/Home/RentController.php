<?php
namespace App\Http\Controllers\Home;

use App\Models\RentModel;

class RentController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'rent';

    public function index()
    {
        $result = [
            'lists'=> $this->list,
            'datas'=> $this->query(),
            'curr_menu'=> $this->curr,
        ];
        return view('home.rent.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '详情';
        $data = RentModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $data->uid,
        ];
        return view('home.rent.show', $result);
    }




    public function query()
    {
        $datas = RentModel::where('genre',1)
            ->where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}