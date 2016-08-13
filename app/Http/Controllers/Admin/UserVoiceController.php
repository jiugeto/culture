<?php
namespace App\Http\Controllers\Admin;

use App\Models\UserVoiceModel;
use Illuminate\Http\Request;

class UserVoiceController extends BaseController
{
    /**
     * 系统后台用户心声管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '用户心声';
        $this->crumb['category']['name'] = '心声管理';
        $this->crumb['category']['url'] = 'uservoice';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'crumb'=> $this->crumb,
            'prefix_url'=> '/admin/uservoice',
            'curr'=> $curr,
        ];
        return view('admin.uservoice.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> UserVoiceModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.uservoice.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        UserVoiceModel::where('id',$id)->update($data);
        return redirect('/admin/uservoice');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> UserVoiceModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.uservoice.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'title'=> $request->name,
            'content'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($isshow=null)
    {
        $datas = UserVoiceModel::where('del',0)
            ->where('isshow',$isshow)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}