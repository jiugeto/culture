<?php
namespace App\Http\Controllers\Person;

use App\Models\BaseModel;
use App\Models\GoodsModel;
use App\Models\Online\ProductModel;

class HomeController extends BaseController
{
    /**
     * 个人后台首页
     */
    protected $goodsModel;
    protected $productModel;

    public function __construct()
    {
        parent::__construct();
        $this->goodsModel = new GoodsModel();
        $this->productModel = new ProductModel();
    }

    public function index($from=1,$type=0)
    {
        if ($from==1) {
            $prefix_url = DOMAIN.'person';
        } elseif ($from==2) {
            $prefix_url = DOMAIN.'person/s/'.$from.'/'.$type;
        }
        $result = [
            'datas'=> $this->query($from,$type),
            'prefix_url'=> $prefix_url,
            'goodsModel'=> $this->goodsModel,
            'productModel'=> $this->productModel,
            'model'=> new BaseModel(),
            'user'=> $this->user,
            'from'=> $from,
            'type'=> $type,
        ];
        return view('person.home.index', $result);
    }





    /**
     * 查询：from片源，type供求类型
     */
    public function query($from,$type)
    {
        //视频供应：type==0:[2,4];
        //type==1:2设计师供应; type==2:4企业供应
        if ($from==1) {
            $datas = $this->goods($type);
        } elseif ($from==2) {
            $datas = $this->products($type);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 视频查询，会员作品，type==2设计师供应，4企业供应
     */
    public function goods($type)
    {
        if ($type) {
            $datas = GoodsModel::where('del',0)
                ->where('genre',1)          //1代表产品，2代表花絮
                ->where('isshow',1)
                ->whereIn('type',[2,4])
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = GoodsModel::where('del',0)
                ->where('genre',1)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }

    /**
     * 在线创作查询
     */
    public function products($type)
    {
        //genre==1:个人供应；genre==2:企业供应
        if ($type) {
            $datas = ProductModel::where('del',0)
                ->where('genre',$type)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ProductModel::where('del',0)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}