<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\LinkModel;
use App\Models\Base\PicModel;
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
            'prefix_url'=> DOMAIN.'company/admin/link',
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
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
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.link.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        LinkModel::create($data);
        return redirect('/company/admin/link');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> LinkModel::find($id),
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.link.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        LinkModel::where('id',$id)->update($data);
        return redirect('/company/admin/link');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> LinkModel::find($id),
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.link.show', $result);
    }




    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'cid'=> $this->cid,
            'type_id'=> $request->type_id,
            'pic_id'=> $request->pic_id,
            'intro'=> isset($request->intro) ? $request->intro : '',
            'link'=> $request->link,
            'display_way'=> $request->display_way,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    public function query()
    {
        $datas = LinkModel::where('cid',$this->cid)
                ->where('type_id', 2)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}