<?php
namespace App\Http\Controllers\Member;

//use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\UserModel;

class OrderController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderModel();
        //面包屑处理
        $this->lists['func']['name'] = '订单管理';
        $this->lists['func']['url'] = 'order';
//        $this->lists['create']['name'] = '添加类型';
//        $this->lists['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '订单列表';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/member/order',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.order.index', $result);
    }

    /**
     * 前台下的订单，这里统一处理
     */
    public function create($data)
    {
        if (\Illuminate\Support\Facades\Request::ajax()) {
            $datas = \Illuminate\Support\Facades\Input::all();
            dd($datas);
            //1创意，2分镜，3商品，4娱乐，5演员，6租赁
            if ($datas[0]=='idea') {
                $ideaModel = \App\Models\IdeasModel::find($datas[1]);
                $genre = 1; $productname = $ideaModel->name;
                $sellerid = $ideaModel->uid;
            }
            //获取供应方信息
            $userModel = UserModel::find($sellerid);
            $create = [
                'name'=> $productname,
                'serial'=> date('YmdHis',time()).rand(0,10000),
                'genre'=> $genre,
                'fromid'=> $datas[1],
                'seller'=> $sellerid,
                'sellerName'=> $userModel->username,
                'buyer'=> $this->userid,
                'buyerName'=> \Session::get('user.username'),
//            'number'=> 0,
                'isnew'=> 1,        //1代表新订单
                'status'=> 1,        //新创意订单
            ];
            OrderModel::create($create);
        }
        return redirect('/member/order');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> OrderModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.order.show', $result);
    }

    public function query()
    {
        $datas = OrderModel::where('del',0)
            ->where('isshow',1)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        return $datas;
    }
}