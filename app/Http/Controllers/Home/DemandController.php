<?php
namespace App\Http\Controllers\Home;

use App\Models\DesignModel;
use App\Models\EntertainModel;
use App\Models\GoodsModel;
use App\Models\IdeasModel;
use App\Models\RentModel;
use App\Models\StoryBoardModel;

class DemandController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    protected $curr = 'demand';
    protected $genres = [
        1=>'视频需求','创意剧本','分镜需求','娱乐需求','设备需求','设计需求',
    ];
    //具体分类genre1：适合视频、创意、分镜
    protected $genre1s = [
        1=>'',
    ];
    //具体分类genre4：适合娱乐、设备
    protected $genre4s = [
        1=>'',
    ];
    //具体分类genre6：适合设计
    protected $genre6s = [
        1=>'',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=1)
    {
        $result = [
            'datas'=> $this->query($genre),
            'ads'=> $this->ads(),
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'genres'=> $this->genres,
            'genre1s'=> $this->genre1s,
            'genre4s'=> $this->genre4s,
            'genre6s'=> $this->genre6s,
            'genre'=> $genre,

        ];
        return view('home.demand.index', $result);
    }





    public function query($genre)
    {
        if ($genre==1) {
            //视频需求，type==1、3是需求
            $datas = GoodsModel::whereIn('type',[1,3])
                ->where('isshow',1)
                ->where('isshow2',1)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre==2) {
            //创意剧本，genre==2是需求
            $datas = IdeasModel::where('genre',2)
                ->where('isshow',1)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre==3) {
            //分镜需求，genre==2是需求
            $datas = StoryBoardModel::where('genre',2)
                ->where('isshow',1)
                ->where('isshow2',1)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('sort2','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre==4) {
            //演员需求，genre==2是需求
            $datas = EntertainModel::where('genre',2)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre==5) {
            //设备需求，genre==2是需求
            $datas = RentModel::where('genre',2)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre==6) {
            //设计需求，genre==2是需求
            $datas = DesignModel::where('genre',2)
                ->where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    public function ads()
    {
        //adplace_id==3，前台需求页面右侧
        $limit = 2;
        $ads = \App\Models\Base\AdModel::where('uid',0)
            ->where('adplace_id',3)
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