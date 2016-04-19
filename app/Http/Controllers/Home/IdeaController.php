<?php
namespace App\Http\Controllers\Home;

use App\Models\CategoryModel;
use App\Models\IdeasModel;
use App\Tools;
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
            'cates'=> Tools::getChild(CategoryModel::all()),
        ];
        return view('home.idea.index', $result);
    }

    public function show($id)
    {
        return view('home.idea.show',array('data'=>IdeasModel::find($id)));
    }


    public function query()
    {
        return IdeasModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}