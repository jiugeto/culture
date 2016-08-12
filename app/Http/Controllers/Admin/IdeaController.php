<?php
namespace App\Http\Controllers\Admin;

use App\Models\IdeasModel;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '创意列表';
        $this->crumb['category']['name'] = '创意管理';
        $this->crumb['category']['url'] = 'idea';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/idea',
            'curr'=> $curr,
        ];
        return view('admin.idea.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> IdeasModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.idea.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'isshow'=> $request->isshow,
            'sort'=> $request->sort,
        ];
        IdeasModel::where('id',$id)->update($data);
        return redirect('/admin/idea');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> IdeasModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.idea.show', $result);
    }


    public function query()
    {
        $datas = IdeasModel::where('del',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}