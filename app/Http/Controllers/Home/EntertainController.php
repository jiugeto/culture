<?php
namespace App\Http\Controllers\Home;

use App\Models\EntertainModel;
use App\Models\StaffModel;
use App\Models\WorksModel;

class EntertainController extends BaseController
{
    /**
     * 网站前台娱乐频道
     */

    protected $curr = 'entertain';
    protected $staffModel;

    public function __construct()
    {
        parent::__construct();
        $this->staffModel = new StaffModel();
    }

    public function index($genre0=1,$genre=0)
    {
        $result = [
            'lists'=> $this->list,
            'datas'=> $this->query($genre0,$genre),
            'staffModel'=> $this->staffModel,
            'prefix_url'=> DOMAIN.'entertain',
            'curr_menu'=> $this->curr,
            'genre0'=> $genre0,
            'genre'=> $genre,
        ];
        return view('home.entertain.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '公司详情';
        $data = EntertainModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $data->uid,
        ];
        return view('home.entertain.show', $result);
    }

    public function staffShow($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '人员详情';
        $data = StaffModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $data->uid,
        ];
        return view('home.entertain.staffShow', $result);
    }





    public function query($genre0,$genre)
    {
        //只显示供应的
        if ($genre0==1) {
            $datas = EntertainModel::where('del',0)
                ->where('genre',1)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre0==2) {
            if ($genre) {
                $datas = StaffModel::where('del',0)
                    ->where('genre',$genre)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = StaffModel::where('del',0)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}