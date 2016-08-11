<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ThemeModel;

class ThemeController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ThemeModel();
        $this->crumb['']['name'] = '专栏列表';
        $this->crumb['category']['name'] = '专栏管理';
        $this->crumb['category']['url'] = 'talk';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/theme',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ThemeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.edit', $result);
    }

    public function update(Request $request,$id)
    {
        ThemeModel::where('id',$id)->update(['isshow'=> $request->isshow]);
        return redirect('/admin/theme');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ThemeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.show', $result);
    }





    public function query()
    {
        return ThemeModel::paginate($this->limit);
    }
}