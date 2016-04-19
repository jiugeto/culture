<?php
namespace App\Http\Controllers\Home;

use App\Models\TalksModel;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
        ];
        return view('home.talk.index', $result);
    }

    public function show($id)
    {
        return view('home.talk.show', array('data'=>TalksModel::find($id)));
    }


    public function query()
    {
        return TalksModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}