<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\AdModel;
use App\Models\PicModel;
use Illuminate\Http\Request;

class PptController extends BaseController
{
    /**
     * 企业页面 ppt管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '宣传编辑';
        $this->lists['func']['url'] = 'ppt';
        $this->model = new AdModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($isuse=1),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($isuse=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'adplaces'=> $this->model->userAdplaces($this->userid),
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        AdModel::create($data);
        return redirect(DOMAIN.'company/admin/ppt');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> AdModel::find($id),
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.ppt.edit', $result);
    }

    public function destroy($id)
    {
        AdModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'company/admin/ppt');
    }

    public function restore($id)
    {
        AdModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'company/admin/ppt/trash');
    }

    public function forceDelete($id)
    {
        AdModel::where('id',$id)->delete();
        return redirect(DOMAIN.'company/admin/ppt/trash');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'pic_id'=> $request->pic_id,
            'cid'=> $this->cid,
            'title'=> $request->title,
            'url'=> $request->url,
            'sort2'=> $request->sort2,
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($isuse=1)
    {
        $datas = AdModel::where('uid',$this->userid)
            ->where('isuse',$isuse)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}