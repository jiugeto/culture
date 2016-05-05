<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;

class SingleController extends BaseController
{
    /**
     * 企业后台 其他页面（单页）
     */

    protected $genre = 2;       //2代表新加的单页

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '其他页面';
        $this->lists['func']['url'] = 'single';
        $this->model = new ComFuncModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'modules'=> $this->model->singelModules($this->cid),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.single.index', $result);
    }

    public function create()
    {
    }




    public function getData(){}

    public function query()
    {
        return ComFuncModel::where('genre',$this->genre)
                        ->where('sort','desc')
                        ->orderBy('sort','desc')
                        ->orderBy('id','desc')
                        ->paginate($this->limit);
    }
}