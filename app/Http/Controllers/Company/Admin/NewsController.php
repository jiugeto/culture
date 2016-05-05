<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use Illuminate\Http\Request;

class NewsController extends BaseFuncController
{
    /**
     * 公司新闻资讯
     */

    protected $module = 6;        //1代表公司新闻资讯

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '新闻资讯';
        $this->lists['func']['url'] = 'news';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas' => $this->query($this->module),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('company.admin.news.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.news.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->module);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::create($data);
        return redirect('/company/admin/news');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.news.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->module);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFuncModel::where('id',$id)->update($data);
        return redirect('/company/admin/news');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'pics'=> $this->pics,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.news.show', $result);
    }
}