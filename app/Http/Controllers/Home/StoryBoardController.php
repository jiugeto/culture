<?php
namespace App\Http\Controllers\Home;

//use Illuminate\Http\Request;
use App\Models\StoryBoardModel;
use App\Models\StoryBoardLikeModel;

class StoryBoardController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function index($genre=0)
    {
        $this->isnew();
        $result = [
            'lists'=> $this->list,
            'datas'=> $this->query($genre),
            'curr_menu'=> 'storyboard',
            'genre'=> $genre,
        ];
        return view('home.storyboard.index', $result);
    }

    public function show($id)
    {
        return view('home.storyboard.show');
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

    public function like($id)
    {
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $userid = \Session::get('user.uid');
        $storyBoardLikeModel = StoryBoardLikeModel::where(['uid'=>$userid,'sbid'=>$id])->first();
        if ($storyBoardLikeModel) {
            StoryBoardLikeModel::where('id',$storyBoardLikeModel->id)->delete();
        } else {
            $create = array('uid'=>$userid,'sbid'=>$id);
            StoryBoardLikeModel::create($create);
        }
        return redirect('/storyboard');
    }

    public function query($genre,$new=null)
    {
        if ($genre) {
            $datas = StoryBoardModel::where('del',0)
                ->where('isshow',1)
//                ->where('img','<>',0)
                ->where('genre',$genre)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = StoryBoardModel::where('del',0)
                ->where('isshow',1)
//                ->where('img','<>',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}