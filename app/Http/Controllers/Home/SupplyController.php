<?php
namespace App\Http\Controllers\Home;

use App\Models\CompanyModel;

class SupplyController extends BaseController
{
    /**
     * 网站前台供应企业
     */

    protected $curr = 'supply';

    public function __construct()
    {
        parent::__construct();
        $this->model = new CompanyModel();
    }

    public function index($genre=0)
    {
        $result = [
            'datas'=> $this->companys($genre),
            'model'=> $this->model,
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'genre'=> $genre,

        ];
//        dd(date('Y-m-d H',time()),time(),date('Y-m-d H',time()));
        return view('home.supply.index', $result);
    }

    public function companys($genre)
    {
        if ($genre) {
            $datas = CompanyModel::where('genre',$genre)->paginate($this->limit);
        } else {
            $datas = CompanyModel::paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}