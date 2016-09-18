<?php
namespace App\Http\Controllers\Home;

use App\Models\Base\SearchModel;
use App\Models\CompanyModel;
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

    protected $limit = 20;  //每页显示20条记录

    public function __construct()
    {
        parent::__construct();
        $this->model = new SearchModel();
    }

    public function index($genre=1,$keyword='')
    {
        //genre==1创作，2样片，3创意，4分镜，5企业，6影视，7演员，8设备，9设计，
        if ($genre==1) {
            $datas = $this->goods($keyword);
            $datas->url = DOMAIN.'creation/';
        } elseif ($genre==2) {
            $datas = $this->products($keyword);
            $datas->url = DOMAIN.'product/';
        } elseif ($genre==3) {
            $datas = $this->ideas($keyword);
            $datas->url = DOMAIN.'idea/';
        } elseif ($genre==4) {
            $datas = $this->storyboards($keyword);
            $datas->url = DOMAIN.'storyboard/';
        } elseif ($genre==5) {
            $datas = $this->companys($keyword);
            $datas->url = DOMAIN.'company/';
        } elseif ($genre==6) {
            $datas = $this->works($keyword);
            $datas->url = DOMAIN.'entertain/works/show/';
        } elseif ($genre==7) {
            $datas = $this->actors($keyword);
            $datas->url = DOMAIN.'entertain/staff/show/';
        } elseif ($genre==8) {
            $datas = $this->rents($keyword);
            $datas->url = DOMAIN.'rent/';
        } elseif ($genre==9) {
            $datas = $this->designs($keyword);
            $datas->url = DOMAIN.'design/';
        }

        //查询次数自增
//        SearchModel::where('fromid',$fromid)->increment('rate');

        $result = [
            'searchGenre'=> $genre,
            'keyword'=> $keyword,
            'datas'=> isset($datas) ? $datas : [],
            'prefix_url'=> DOMAIN.'s/'.$genre.'/'.$keyword,
        ];
        return view('home.search.index', $result);
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
        $datas = CompanyModel::where('genre',1)
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