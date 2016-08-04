<?php
namespace App\Http\Controllers\Home;

use App\Models\EntertainModel;
use App\Models\StaffModel;

class EntertainController extends BaseController
{
    /**
     * 网站前台娱乐频道
     */

    protected $staffModel;

    public function __construct()
    {
        parent::__construct();
        $this->staffModel = new StaffModel();
    }

    public function index($genre0=1,$genre=0)
    {
        $result = [
            'datas'=> $this->query($genre0,$genre),
            'staffModel'=> $this->staffModel,
            'prefix_url'=> DOMAIN.'entertain',
            'curr_menu'=> 'entertain',
            'genre0'=> $genre0,
            'genre'=> $genre,
        ];
        return view('home.entertain.index', $result);
    }





    public function query($genre0,$genre)
    {
        //只显示供应的
        if ($genre0==1) {
            $datas = EntertainModel::where('genre',1)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre0==2) {
            if ($genre) {
                $datas = StaffModel::where('genre',$genre)
                    ->where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = StaffModel::where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}