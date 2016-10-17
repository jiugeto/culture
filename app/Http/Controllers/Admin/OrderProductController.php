<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\PayModel;
use App\Models\Base\UserGoldModel;
use App\Models\Base\VideoModel;
use App\Models\Base\WalletModel;
use App\Models\Online\OrderProductModel;
use Illuminate\Http\Request;

class OrderProductController extends BaseController
{
    /**
     * 系统后台 创作订单
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderProductModel();
        $this->crumb['']['name'] = '创作订单列表';
        $this->crumb['category']['name'] = '创作订单';
        $this->crumb['category']['url'] = 'orderpro';
    }

    public function index($isshow=0,$status=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isshow,$status),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'admin/orderpro',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
            'status'=> $status,
        ];
        return view('admin.orderpro.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> OrderProductModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.orderpro.show', $result);
    }

    /**
     * 编辑视频
     */
    public function edit($id)
    {
//        $curr['name'] = $this->crumb['edit']['name'];
        $curr['name'] = '视频处理';
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> OrderProductModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.orderpro.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $videoModel = $this->insertVideo($request,$id);
        $data = [
            'video_id'=> $videoModel->id,
            'is_new'=> 1,
            'updated_at'=> time(),
        ];
        OrderProductModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/orderpro');
    }

    public function insertVideo(Request $request,$id)
    {
        if (!$request->pic_id || !$request->link) {
            echo "<script>alert('图片、视频信息必填选！');history.go(-1);</script>";exit;
        }
        if (!strstr($request->link,'?') || !strstr($request->link,'&')) {
            echo "<script>alert('视频信息格式不对！');history.go(-1);</script>";exit;
        }
        $links = explode('?',$request->link);
        $orderProModel = OrderProductModel::find($id);
        $time = time();
        $data = [
            'uid'=> $orderProModel->uid,
            'name'=> $orderProModel->getProductName(),
            'url'=> $links[0],
            'url2'=> $links[1],
            'pic_id'=> $request->pic_id,
            'created_at'=> $time,
        ];
        VideoModel::create($data);
        $videoModel = VideoModel::where($data)->first();
        return $videoModel;
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        if (!$isshow) { echo "<script>alert('参数有误！');history.go(-1);</script>";exit; }
        OrderProductModel::where('id',$id)->update(['isshow'=> $isshow]);
        return redirect(DOMAIN.'admin/orderpro');
    }

    /**
     * 设置状态
     */
    public function setStatus($id,$status)
    {
        if (!$status) { echo "<script>alert('参数有误！');history.go(-1);</script>";exit; }
        OrderProductModel::where('id',$id)->update(['status'=> $status]);
        return redirect(DOMAIN.'admin/orderpro');
    }

    /**
     * 设置定价
     */
    public function setMoney($id,$money)
    {
        $orderProModel = OrderProductModel::find($id);
        $formatMoney = $orderProModel->getFormatMoney();
        $data = [
            'genre'=> 3,        //代表在线创作订单
            'order_id'=> $id,
            'money'=> $formatMoney+$money,
            'weal'=> $formatMoney,
            'created_at'=> time(),
        ];
        PayModel::create($data);
        //创作订单表状态更新
        OrderProductModel::where('id',$id)->update(['status'=> 2]);
        return redirect(DOMAIN.'admin/orderpro');
    }

    /**
     * 设置好评的返金币
     */
    public function setBackGold($id,$uid)
    {
        OrderProductModel::where('id',$id)->update(['status'=> 8]);
        //更新基本数量
        UserGoldModel::setGold($uid,4,5);
        $walletModel = WalletModel::where('uid',$uid)->first();
        WalletModel::where('uid',$uid)->update(['gold'=> $walletModel->gold+5]);
        return redirect(DOMAIN.'admin/orderpro');
    }






    public function query($isshow,$status)
    {
        if ($isshow && $status) {
            $datas = OrderProductModel::where('isshow',$isshow)
                ->where('status',$status)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$isshow && $status) {
            $datas = OrderProductModel::where('status',$status)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($isshow && !$status) {
            $datas = OrderProductModel::where('isshow',$isshow)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$isshow && !$status) {
            $datas = OrderProductModel::orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}