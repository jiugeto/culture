<?php
namespace App\Http\Controllers\Home;

use App\Models\Base\SearchModel;
use App\Models\DesignModel;
use App\Models\GoodsModel;
use App\Models\IdeasModel;
use App\Models\ProductModel;
use App\Models\RentModel;
use App\Models\StaffModel;
use App\Models\StoryBoardModel;
use App\Models\WorksModel;

class SearchController extends BaseController
{
    /**
     * 前台搜索
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new SearchModel();
    }

    public function index($genre=1,$keyword='')
    {
        //genre==1样片，2创意，3分镜，4企业，5影视，6演员，7设备，8设计，
        if ($genre==1) {
            $goods = $this->goods($keyword);
            $products = $this->products($keyword);
        } elseif ($genre==2) {
            $ideas = $this->ideas($keyword);
        } elseif ($genre==3) {
            $storyboards = $this->storyboards($keyword);
        } elseif ($genre==4) {
            $companys = $this->companys($keyword);
        } elseif ($genre==5) {
            $works = $this->works($keyword);
        } elseif ($genre==6) {
            $actors = $this->actors($keyword);
        } elseif ($genre==7) {
            $rents = $this->rents($keyword);
        } elseif ($genre==8) {
            $designs = $this->designs($keyword);
        }
        if ($genre==2) {
            $view = 'text';
        } else {
            $view = 'img';
        }
        $result = [
            'searchGenre'=> $genre,
            'keyword'=> $keyword,
            'goods'=> isset($goods) ? $goods : [],
            'products'=> isset($products) ? $products : [],
            'ideas'=> isset($ideas) ? $ideas : [],
            'storyboards'=> isset($storyboards) ? $storyboards : [],
            'companys'=> isset($companys) ? $companys : [],
            'works'=> isset($works) ? $works : [],
            'actors'=> isset($actors) ? $actors : [],
            'rents'=> isset($rents) ? $rents : [],
            'designs'=> isset($designs) ? $designs : [],
        ];
        return view('home.search.'.$view, $result);
    }





    /**
     * 上传的样片
     */
    public function goods($keyword)
    {
        //genre==1：产品系列，type==2/4：设计师供应/企业供应，cate样片类型
        $datas = GoodsModel::where('genre',1)
            ->whereIn('type',[2,4])
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = GoodsModel::where('genre',1)
                ->whereIn('type',[2,4])
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 在线创作的
     */
    public function products($keyword)
    {
        //genre==1：个人供应，cate样片类型
        $datas = ProductModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = GoodsModel::where('genre',1)
                ->whereIn('type',[2,4])
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 创意
     */
    public function ideas($keyword)
    {
        //genre==1：供应，cate样片类型
        $datas = ProductModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = IdeasModel::where('genre',1)
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 分镜列表
     */
    public function storyboards($keyword)
    {
        //genre==1：供应，cate样片类型
        $datas = StoryBoardModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = StoryBoardModel::where('genre',1)
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 公司列表
     */
    public function companys($keyword)
    {
        //genre==1：供应
        $datas = StoryBoardModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 影视作品列表
     */
    public function works($keyword)
    {
        //genre==1：供应，cate样片类型
        $datas = WorksModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = WorksModel::where('genre',1)
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 演员列表
     */
    public function actors($keyword)
    {
        //genre==1：演员
        $datas = StaffModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 设备列表
     */
    public function rents($keyword)
    {
        //genre==1：供应
        $datas = RentModel::where('genre',1)
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 设计列表
     */
    public function designs($keyword)
    {
        //genre==1/3：供应，cate设计类型
        $datas = DesignModel::whereIn('genre',[1,3])
            ->where('name','%'.$keyword.'%')
            ->paginate($this->limit);
        if (!count($datas) && $cate=$this->getCate($keyword)) {
            $datas = DesignModel::where('genre',1)
                ->where('cate',$cate)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getCate($keyword)
    {
        foreach ($this->model['cates2'] as $kcate=>$vcate) {
            if ('%'.$keyword.'%'==$vcate) { $cate = $vcate; }
        }
        return isset($cate) ? $cate : 0;
    }
}