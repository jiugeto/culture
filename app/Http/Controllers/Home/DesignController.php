<?php
namespace App\Http\Controllers\Home;

use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'design';

    public function __construct()
    {
        parent::__construct();
        $this->model = new DesignModel();
    }

    public function index($cate=0)
    {
        $result = [
            'lists'=> $this->list,
            'datas'=> $this->query($cate),
            'model'=> $this->model,
            'curr_menu'=> $this->curr,
            'cate'=> $cate,
        ];
        return view('home.design.index', $result);
    }

    public function show($id)
    {
        $data = DesignModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'uid'=> $data->uid,
        ];
        return view('home.design.show', $result);
    }





    public function query($cate)
    {
        if ($cate) {
            $datas = DesignModel::where('del',0)
                ->where('genre',1)
                ->where('cate',$cate)
                ->paginate($this->limit);
        } else {
            $datas = DesignModel::where('del',0)
                ->where('genre',1)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}