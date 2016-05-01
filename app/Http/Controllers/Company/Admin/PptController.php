<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComPptModel;
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
        $this->model = new ComPptModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.ppt.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.ppt.index', $result);
    }

    public function create()
    {
        $pptModels = ComPptModel::where('cid',$this->cid)->get();
        if (count($pptModels)>$this->comPptNum-1) {
            echo "<script>alert('您的公司已有".$this->comPptNum."宣传记录！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.ppt.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComPptModel::create($data);
        return redirect('/company/admin/ppt');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ComPptModel::find($id),
            'pics'=> PicModel::where('uid',$this->userid)->get(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.ppt.edit', $result);
    }

    public function destroy($id)
    {
        ComPptModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/company/admin/ppt');
    }

    public function restore($id)
    {
        ComPptModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/company/admin/ppt/trash');
    }

    public function forceDelete($id)
    {
        ComPptModel::where('id',$id)->delete();
        return redirect('/company/admin/ppt/trash');
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
    public function query($del=0)
    {
        return ComPptModel::where('cid',$this->cid)
            ->where('del',$del)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}