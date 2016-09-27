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
            'datas'=> $this->query($cate),
            'prefix_url'=> DOMAIN.'design',
            'ads'=> $this->ads(),
            'lists'=> $this->list,
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

    public function ads()
    {
        //adplace_id==5，前台设计页面右侧
        $limit = 2;
        $ads = \App\Models\Base\AdModel::where('uid',0)
            ->where('adplace_id',5)
            ->where('isuse',1)
            ->where('isshow',1)
            ->where('fromTime','<',time())
            ->where('toTime','>',time())
            ->orderBy('sort','desc')
            ->paginate($limit);
        $ads->limit = $limit;
        return $ads;
    }
}