<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\LinkModel;
use App\Models\PicModel;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * 企业页面 链接控制
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '链接管理';
        $this->lists['func']['url'] = 'link';
        $this->model = new LinkModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.link.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.link.create', $result);
    }

    public function store(Request $request){}

    public function edit($id){}

    public function update(Request $request,$id){}




    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'type_id'=> $request->type_id,
            'pic_id'=> $request->pic_id,
            'intro'=> isset($request->intro) ? $request->intro : '',
            'sort'=> $request->sort,
            'link'=> $request->link,
            'display_way'=> $request->display_way,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    public function query()
    {
        return LinkModel::where('cid',$this->cid)
                    ->where('type_id', 2)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
    }
}