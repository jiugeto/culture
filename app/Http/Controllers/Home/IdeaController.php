<?php
namespace App\Http\Controllers\Home;

use App\Models\IdeasModel;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
        ];
        return view('home.idea.index', $result);
    }


    public function query()
    {
        return IdeasModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}