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
        $proVideoModel = ProductVideoModel::find($id);
        $serial = date('YmdHis',time()).rand(0,10000);
        $formats = array_flip($this->orderProModel['formatMoneys']);
        $format = array_key_exists($request->formatMoney,$formats)?$formats[$request->formatMoney]:0;
        $time = time();
        $data = [
            'productid'=> $id,
            'serial'=> $serial,
            'genre'=> 2,    //离线模板
            'cate'=> $proVideoModel->cate,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'seller'=> $proVideoModel->uid,
            'format'=> $format,
            'record'=> $request->intro,
            'created_at'=> $time,
        ];
        OrderProductModel::create($data);
//        dd($data);

        //价格处理
        $orderProModel = OrderProductModel::where($data)->first();
        $data1 = [
            'genre'=> 3,        //代表在线创作订单
            'order_id'=> $orderProModel->id,
//            'money'=> ,
//            'weal'=> ,
            'created_at'=> $time,
        ];
        PayModel::create($data1);

        return redirect(DOMAIN.'member/orderpro');
    }

    /**
     * 效果定制添加
     */
    public function insertEffect(Request $request)
    {
        if (!$this->userid) { echo "<script>alert('还没有登录，请先登录！');history.go(-1);</script>";exit; }
        if (!$request->intro || !$request->link) {
            echo "<script>alert('视频效果链接、修改要求必填！');history.go(-1);</script>";exit;
        }
        $time = time();
        $data = [
            'genre'=> 2,    //代表效果定制
            'intro'=> $request->intro,
            'link'=> $request->link,
            'uid'=> $this->userid,
            'created_at'=> $time,
        ];
        dd('11',$request->all());
        ProductVideoModel::create($data);

        //插入创作订单表
        $data1 = [];
        OrderProductModel::ceate($data1);

        //支付表
        $data3 = [];
        PayModel::create($data3);

        return redirect(DOMAIN.'member/orderpro');
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
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = OrderProductModel::where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}