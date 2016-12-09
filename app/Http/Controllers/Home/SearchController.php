<?php
namespace App\Http\Controllers\Home;

use App\Models\Home\SearchKeywordModel;
use App\Models\Home\SearchModel;
use App\Models\CompanyModel;
use App\Models\DesignModel;
use App\Models\GoodsModel;
use App\Models\IdeasModel;
use App\Models\Online\ProductModel;
use App\Models\RentModel;
use App\Models\StaffModel;
use App\Models\StoryBoardModel;
use App\Models\WorksModel;
use Redis;

class SearchController extends BaseController
{
    /**
     * 前台搜索
     */

    protected $limit = 20;  //每页显示20条记录

    public function __construct()
    {
        parent::__construct();
        $this->model = new SearchModel();
    }

    public function index($genre=1,$keyword='')
    {
        //查看缓存有无结果，有则读取，无则查表
        $key = 'search_'.$genre.'_'.$keyword;
        if (Redis::exists($key)) {
            $datas = unserialize(Redis::get($key));
        } else {
            $datas = $this->getDatas($genre,$keyword);
            //假如有结果，更新缓存中的结果
            if (count($datas)) {
                Redis::setex($key, 3600, serialize($datas));     //缓存一小时
            }
        }

        $result = [
            'searchGenre'=> $genre,
            'keyword'=> $keyword,
            'datas'=> isset($datas) ? $datas : [],
            'prefix_url'=> DOMAIN.'s/'.$genre.'/'.$keyword,
        ];
        return view('home.search.index', $result);
    }

    public function getDatas($genre,$keyword)
    {
        //genre==1创作，2样片，3创意，4分镜，5企业，6影视，7演员，8设备，9设计，
        $datas = SearchModel::where('genre',$genre)->where('keyword','like','%'.$keyword.'%')->get();
        $searchIds = array();
        if (count($datas)) {
            foreach ($datas as $data) {
                $searchIds[] = $data->fromid;

                //处理关键字才行频率
                if (SearchKeywordModel::where('search_id',$data->id)->first()) {
                    //假如有记录，更新频率 rate
                    SearchKeywordModel::where('search_id',$data->id)->update(array('updated_at'=>time()));
                    SearchKeywordModel::where('search_id',$data->id)->increment('rate');
                } else {
                    $searchKeyword = [
                        'search_id'=> $data->id,
                        'keyword'=> $keyword,
                        'created_at'=> time(),
                    ];
                    SearchKeywordModel::create($searchKeyword);
                }
            }
        }
        if ($genre==1) {
            $datas = ProductModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'creation/';
        } elseif ($genre==2) {
            $datas = GoodsModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'product/';
        } elseif ($genre==3) {
            $datas = IdeasModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'idea/';
        } elseif ($genre==4) {
            $datas = StoryBoardModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'storyboard/';
        } elseif ($genre==5) {
//            $datas = CompanyModel::whereIn('id',$searchIds)
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//            $datas->url = DOMAIN.'company/';
        } elseif ($genre==6) {
            $datas = WorksModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'entertain/works/show/';
        } elseif ($genre==7) {
            $datas = StaffModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'entertain/staff/show/';
        } elseif ($genre==8) {
            $datas = RentModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'rent/';
        } elseif ($genre==9) {
            $datas = DesignModel::whereIn('id',$searchIds)
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->url = DOMAIN.'design/';
        }
        $datas->limit = $this->limit;
        return $datas;
    }





    /**
     * 初始化搜索表
     */
    public function init()
    {
        //在线创作表
        $products = ProductModel::all();
        if (count($products)) {
            $rst['product'] = $this->tochange($products,'product');
        } else {
            $rst['product'] =  "在线创作表 product 没有记录！";
        }
        //上传的产品表
        $goods = GoodsModel::all();
        if (count($goods)) {
            $rst['goods'] = $this->tochange($goods,'goods');
        } else {
            $rst['goods'] = "上传的产品表 goods 没有记录！";
        }
        //创意表
        $ideas = IdeasModel::all();
        if (count($ideas)) {
            $rst['idea'] = $this->tochange($ideas,'idea');
        } else {
            $rst['idea'] = "创意表 idea 没有记录！";
        }
        //分镜表
        $storyboards = StoryBoardModel::all();
        if (count($ideas)) {
            $rst['storyboard'] = $this->tochange($storyboards,'storyboard');
        } else {
            $rst['storyboard'] = "分镜表 storyboard 没有记录！";
        }
        //公司表
//        $companys = CompanyModel::all();
//        if (count($ideas)) {
//            $rst['company'] = $this->tochange($companys,'company');
//        } else {
//            $rst['company'] = "公司表 company 没有记录！";
//        }
        //影视作品表
        $works = WorksModel::all();
        if (count($works)) {
            $rst['works'] = $this->tochange($works,'works');
        } else {
            $rst['works'] = "作品表 works 没有记录！";
        }
        //演员表
        $actors = StaffModel::where('genre',1)->get();
        if (count($actors)) {
            $rst['actor'] = $this->tochange($actors,'actor');
        } else {
            $rst['actor'] = "人员表演员 actor 没有记录！";
        }
        //租赁表
        $rents = RentModel::all();
        if (count($rents)) {
            $rst['rent'] = $this->tochange($rents,'rent');
        } else {
            $rst['rent'] = "租赁表 rent 没有记录！";
        }
        //设计表
        $designs = DesignModel::all();
        if (count($designs)) {
            $rst['design'] = $this->tochange($designs,'design');
        } else {
            $rst['design'] = "设计表 design 没有记录！";
        }
        dd($rst);
    }

    /**
     * 用于初始化
     * 改变搜索表记录
     */
    public function tochange($datas,$genre)
    {
        foreach ($datas as $data) {
            $keyword = $this->getKeyword($data,$genre);
            if ($this->getSearch($keyword['genre'],$data->id)) {
                $update = [
                    'keyword'=> $keyword['keyword'],
                    'updated_at'=> time(),
                ];
                SearchModel::where('genre',$keyword['genre'])
                    ->where('fromid',$data->id)
                    ->update($update);
                $rst[] = $genre.'的id=='.$data->id.'更新完毕！';
            } else {
                $create = [
                    'keyword'=> $keyword['keyword'],
                    'genre'=> $keyword['genre'],
                    'fromid'=> $data->id,
                    'created_at'=> time(),
                ];
                SearchModel::create($create);
                $rst[] = $genre.'的id=='.$data->id."添加完毕！";
            }
        }
        return $rst;
    }

    /**
     * 用于初始化
     * 根据 fromid 查询搜索表记录
     */
    public function getSearch($genre,$fromid)
    {
        return SearchModel::where('genre',$genre)
            ->where('fromid',$fromid)
            ->first();
    }

    /**
     * 用于初始化
     * 组合关键字
     */
    public function getKeyword($data,$genre)
    {
        $model = new SearchModel();
        if ($genre=='product') {
            $keyword = $data->name.$data->uname;
            $genre = 1;
        } elseif ($genre=='goods') {
            $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
            $genre = 2;
        } elseif ($genre=='idea') {
            $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
            $genre = 3;
        } elseif ($genre=='storyboard') {
            $keyword = $data->name.$data->uname.$model['cates2'][$data->cate].$data->money.'元';
            $genre = 4;
        } elseif ($genre=='company') {
            $companyModel = new CompanyModel();
            $genreName = array_key_exists($data->genre,$companyModel['genres']) ? $companyModel['genres'][$data->genre] : '';
            $keyword = $data->name.$data->uname.$genreName.
                $companyModel->getAreaName($data->area).$data->address;
            $genre = 5;
        } elseif ($genre=='works') {
            $keyword = $data->name.$model['cates2'][$data->cate];
            $genre = 6;
        } elseif ($genre=='actor') {
            $education = new StaffModel();
            $keyword = $data->name.$data->realname.$data->origin.
                $education['educations'][$data->education].$data->school.$education->getAreaName($data->area);
            $genre = 7;
        } elseif ($genre=='rent') {
            $rentModel = new RentModel();
            $keyword = $data->name.$rentModel->getAreaName($data->area).$data->money.'元';
            $genre = 8;
        } elseif ($genre=='design') {
            $keyword = $data->name.$model['cates1'][$data->cate].$data->money.'元';
            $genre = 9;
        }
        return array(
            'keyword'=> $keyword,
            'genre'=> $genre,
        );
    }
}