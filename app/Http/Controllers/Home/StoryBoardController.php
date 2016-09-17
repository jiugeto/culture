<?php
namespace App\Http\Controllers\Home;

//use Illuminate\Http\Request;
use App\Models\StoryBoardModel;
use App\Models\StoryBoardLikeModel;
use App\Models\Base\OrderModel;

class StoryBoardController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    protected $curr = 'storyboard';
    protected $genre = 1;       //1代表供应

    public function __construct()
    {
        parent::__construct();
        $this->model = new StoryBoardModel();
    }

    public function index($way=0,$cate=0)
    {
        $this->isnew();
        $result = [
            'datas'=> $this->query($way,$cate),
            'model'=> $this->model,
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'way'=> $way,
            'cate'=> $cate,
        ];
        return view('home.storyboard.index', $result);
    }

    public function show($id)
    {
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $data = StoryBoardModel::find($id);
        //内容查看权限开关
        if ($data->genre==1) {
            //供应分镜
            $orderModel = OrderModel::where('genre',3)
                ->where('buyer',$this->userid)
                ->where('status','>',11)
                ->where('isshow',1)
                ->where('del',0)
                ->first();
        } elseif ($data->genre==2) {
            //需求分镜
            $orderModel = OrderModel::where('genre',4)
                ->where('seller',$this->userid)
                ->where('status','>',11)
                ->where('isshow',1)
                ->where('del',0)
                ->first();
        }
        $data->iscon = 0;
        if (isset($orderModel) && $orderModel) {
            if ($orderModel->status < 12) { $data->iscon = 1; }
            elseif ($orderModel->status == 13) { $data->iscon = 2; }
            elseif ($orderModel->status == 12) { $data->iscon = 3; }
            $data->remarks = $orderModel->remarks;
        }
        $result = [
            'data'=> $data,
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'uid'=> $this->userid,
        ];
        return view('home.storyboard.show', $result);
    }

    /**
     * 将超过5天的记录 isnew设置0
     */
    public function isnew()
    {
        $day = 86400;       //一天的秒数
        //计算5天前时间
        $oldTime = date('Y-m-d H:i:s',time()-$day*5);
        StoryBoardModel::where('created_at','<',$oldTime)->update(['isnew'=> 0]);
//        return $oldTime;
    }

    public function like($way,$id)
    {
        //登录权限限制
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $userid = \Session::get('user.uid');
        $storyBoardLikeModel = StoryBoardLikeModel::where(['uid'=>$userid,'sbid'=>$id])->first();
        if ($storyBoardLikeModel) {
            StoryBoardLikeModel::where('id',$storyBoardLikeModel->id)->delete();
        } else {
            $create = array('uid'=>$userid,'sbid'=>$id);
            StoryBoardLikeModel::create($create);
        }
        //确定所在页面：1index,2show
        if ($way==2) { return redirect('/storyboard/'.$id); }
        elseif ($way==1) { return redirect('/storyboard'); }
    }

    public function query($way,$cate)
    {
        //way：0所有，1最新isnew，2最热ishot
        if ($way==0) {
            if ($cate) {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('cate',$cate)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        } elseif ($way==1) {
            if ($cate) {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('isnew',1)
                    ->where('cate',$cate)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('isnew',1)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        } elseif ($way==2) {
            if ($cate) {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('ishot',1)
                    ->where('cate',$cate)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = StoryBoardModel::where('del',0)
                    ->where('isshow',1)
                    ->where('ishot',1)
                    ->where('genre',$this->genre)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}