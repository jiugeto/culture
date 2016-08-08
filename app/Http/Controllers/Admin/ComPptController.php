<?php
namespace App\Http\Controllers\Admin;

use App\Models\Company\ComPptModel;
use App\Models\PicModel;
use Illuminate\Http\Request;

class ComPptController extends BaseController
{
    /**
     * 企业宣传PPT管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '宣传列表';
        $this->crumb['category']['name'] = '企业宣传';
        $this->crumb['category']['url'] = 'comppt';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/comppt',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comppt.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/admin/comppt',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comppt.index', $result);
    }

    public function create()
    {
        if (count(ComPptModel::where('cid',0)->get())>$this->comPptNum-1) {
            echo "<script>alert('宣传记录限制".$this->comPptNum."条！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comppt.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ComPptModel::create($data);
        return redirect('/admin/comppt');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComPptModel::find($id),
            'pics'=> PicModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comppt.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ComPptModel::where('id',$id)->update($data);
        return redirect('/admin/comppt');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComPptModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comppt.show', $result);
    }

    public function destroy($id)
    {
        ComPptModel::where('id',$id)->update(array('del'=> 1));
        return redirect('/admin/comppt');
    }

    public function restore($id)
    {
        ComPptModel::where('id',$id)->update(array('del'=> 0));
        return redirect('/admin/comppt/trash');
    }

    public function forceDelete($id)
    {
        ComPptModel::where('id',$id)->delete();
        return redirect('/admin/comppt/trash');
    }





    /**
     * ======================
     * 以下是公用方法
     * ======================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $pic = [
            'pic_id'=> $request->pic_id,
            'title'=> $request->title,
            'url'=> $request->url,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $pic;
    }

    public function query($del=0)
    {
        return ComPptModel::where('del',$del)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
    }
}