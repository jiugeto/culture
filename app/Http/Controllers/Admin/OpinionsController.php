<?php
namespace App\Http\Controllers\Admin;

use App\Models\OpinionModel;
//use Illuminate\Http\Request;
//use App\Tools;

class OpinionsController extends BaseController
{
    /**
     *系统后台用户意见管理
     */

    public function __construct()
    {
        $this->crumb['']['name'] = '意见列表';
        $this->crumb['category']['name'] = '意见管理';
        $this->crumb['category']['url'] = 'opinions';
    }

    public function index($isshow=1)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isshow),
            'prefix_url'=> '/admin/opinions',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> OpinionModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.edit', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> OpinionModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.show', $result);
    }

    public function destroy($id)
    {
        OpinionModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/opinions');
    }

    public function query($isshow)
    {
        $datas = OpinionModel::where('del',0)
                ->where('isshow',$isshow)
                ->paginate($this->limit);
        return $datas;
    }
}