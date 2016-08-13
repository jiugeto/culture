<?php
namespace App\Http\Controllers\Person;

use App\Models\GoodsModel;

class HomeController extends BaseController
{
    /**
     * 个人后台首页
     */

    public function index()
    {
        return view('person.home.index');
    }





    public function goods($type)
    {
        if ($type) {
            $datas = GoodsModel::where()->paginate($this->limit);
        }
    }
}