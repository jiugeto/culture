<?php
namespace App\Http\Controllers\Admin;

use App\Models\Home\OpinionModel;
use Illuminate\Http\Request;

class OpinionsController extends BaseController
{
    /**
     *系统后台用户意见管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '意见列表';
        $this->crumb['category']['name'] = '意见管理';
        $this->crumb['category']['url'] = 'opinions';
    }

    public function index($isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isshow),
            'prefix_url'=> DOMAIN.'admin/opinions',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
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

    public function update(Request $request,$id)
    {
        $data = ['isshow'=>$request->isshow];
        OpinionModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/opinions');
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
        return redirect(DOMAIN.'admin/opinions');
    }

    public function restore($id)
    {
        OpinionModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'admin/opinions/trash');
    }

    public function forceDelete($id)
    {
        OpinionModel::where('id',$id)->delete;
        return redirect(DOMAIN.'admin/opinions/trash');
    }

    public function query($isshow)
    {
        if ($isshow) {
            $datas = OpinionModel::where('isshow',$isshow)
                ->paginate($this->limit);
        } else {
            $datas = OpinionModel::paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}