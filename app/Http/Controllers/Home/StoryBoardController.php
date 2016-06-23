<?php
namespace App\Http\Controllers\Home;

//use Illuminate\Http\Request;
use App\Models\StoryBoardModel;

class StoryBoardController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function index($genre=0)
    {
        $result = [
            'datas'=> $this->query($genre),
            'curr_menu'=> 'rent',
            'genre'=> $genre,
        ];
        return view('home.storyboard.index', $result);
    }

    public function query($genre)
    {
        if ($genre) {
            $datas = StoryBoardModel::where('del',0)
                ->where('isshow',1)
                ->where('genre',$genre)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = StoryBoardModel::where('del',0)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}