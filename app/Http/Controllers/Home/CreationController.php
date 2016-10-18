<?php
namespace App\Http\Controllers\Home;

use App\Models\Base\PayModel;
use App\Models\Base\WalletModel;
use App\Models\Online\OrderProductModel;
use App\Models\Online\ProductModel;
use App\Models\Online\ProductVideoModel;
use Illuminate\Http\Request;

class CreationController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    protected $limit = 20;      //每页显示记录数
    protected $orderProModel;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
        $this->orderProModel = new OrderProductModel();
    }

    public function index($genre=1,$cate=0,$orderPro=1)
    {
        $wallet = WalletModel::where('uid',$this->userid)->first();
        $result = [
            'datas'=> $orderPro==1?$this->query($genre,$cate):$this->orderPros($genre,$cate),
            'prefix_url'=> DOMAIN.'creation',
            'model'=> $this->model,
            'curr_menu'=> 'creation',
            'genre'=> $genre,
            'cate'=> $cate,
            'orderPro'=> $orderPro,
            'orderProModel'=> $this->orderProModel,
            'wallet'=> $wallet,
        ];
        return view('home.creation.index', $result);
    }

    /**
     * 动画模板的修改意见编辑
     */
    public function editLayer($id)
    {
        $data = ProductModel::find($id);
        $wallet = WalletModel::where('uid',$this->userid)->first();
        $result = [
            'video'=> $data->getVideo(),
            'videoName'=> $data->name,
            'data'=> $data,
            'orderProModel'=> $this->orderProModel,
            'wallet'=> $wallet,
        ];
        return view('home.creation.editLayer', $result);
    }

    /**
     * 动画模板的修改意见更新
     */
    public function updateLayer(Request $request,$id)
    {
        if (!$this->userid) { echo "<script>alert('还没有登录，请先登录！');history.go(-1);</script>";exit; }
        if (!$request->intro) {
            echo "<script>alert('修改要求必填！');history.go(-1);</script>";exit;
        }

        //创作订单表
        $proVideoModel = ProductVideoModel::find($id);
        $data = $this->addOrderPro($request,2,$proVideoModel);

        return redirect(DOMAIN.'member/orderpro');
    }

    /**
     * 效果定制添加
     */
    public function insertEffect(Request $request)
    {
        if (!$this->userid) { echo "<script>alert('还没有登录，请先登录！');history.go(-1);</script>";exit; }
        if (!$request->name || !$request->intro || !$request->link) {
            echo "<script>alert('视频名称、效果链接、修改要求必填！');history.go(-1);</script>";exit;
        } elseif (strlen($request->name)<2 || strlen($request->name)>20) {
            echo "<script>alert('名称2-20字符！');history.go(-1);</script>";exit;
        } elseif (!preg_match("/https?:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is",$request->link)) {
            echo "<script>alert('链接地址格式不对！');history.go(-1);</script>";exit;
        }
        $time = time();
        $proVideo = [
            'name'=> $request->name,
            'genre'=> 2,    //代表效果定制
            'intro'=> $request->intro,
            'link'=> $request->link,
            'uid'=> $this->userid,
            'created_at'=> $time,
        ];
        ProductVideoModel::create($proVideo);

        //插入创作订单表
        $proVideoModel = ProductVideoModel::where($proVideo)->first();
        $this->addOrderPro($request,3,$proVideoModel);

        return redirect(DOMAIN.'member/orderpro');
    }

    /**
     * 插入创作订单表
     */
    public function addOrderPro($request,$genre,$proVideoModel)
    {
        $serial = date('YmdHis',time()).rand(0,10000);
        $formats = array_flip($this->orderProModel['formatMoneys']);
        $format = array_key_exists($request->formatMoney,$formats)?$formats[$request->formatMoney]:0;
        $time = time();
        $data = [
            'productid'=> $proVideoModel->id,
            'serial'=> $serial,
            'genre'=> $genre,
            'cate'=> $proVideoModel->cate,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'seller'=> $proVideoModel->uid,
            'format'=> $format,
            'record'=> $request->intro,
//            'video_id'=> ,    //动画成品id
            'created_at'=> $time,
        ];
        OrderProductModel::create($data);
        return OrderProductModel::where($data)->first();
    }

    /**
     * 在线创作作品预览
     */
    public function pre($id)
    {
        $data = ProductModel::find($id);
        $result = [
            'video'=> $data->getVideo(),
            'videoName'=> $data->name,
        ];
        return view('layout.videoPre', $result);
    }






    public function query($genre,$cate)
    {
        if ($genre==1) {
            if ($cate) {
                $datas = ProductModel::where('cate',$cate)
                    ->where('video_id','>',0)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = ProductModel::where('video_id','>',0)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        } elseif (in_array($genre,[2,3])) {
            if ($cate) {
                $datas = ProductVideoModel::where('cate',$cate)
                    ->where('genre',$genre-1)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = ProductVideoModel::where('genre',$genre-1)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     *  成功的在线创作订单
     */
    public function orderPros($genre,$cate)
    {
        if ($cate) {
            $datas = OrderProductModel::where('genre',$genre)
                ->where('cate',$cate)
                ->where('video_id','>',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = OrderProductModel::where('genre',$genre)
                ->where('video_id','>',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}