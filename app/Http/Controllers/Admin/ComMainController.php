<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComMainModel;

class ComMainController extends BaseController
{
    /**
     * 系统后台企业主体
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComMainModel();
        $this->crumb['']['name'] = '企业主体列表';
        $this->crumb['category']['name'] = '企业主体管理';
        $this->crumb['category']['url'] = 'commain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/commain',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.commain.index', $result);
    }




//    /**
//     * 收集数据
//     */
//    public function getData(Request $request)
//    {
//        $data = [
//            'name'=> $request->name,
//            'detail'=> $request->detail,
//            'title'=> $request->title,
//            'intro'=> $request->intro,
//            'small'=> $request->small,
//            'pic_id'=> $request->pic_id?$request->pic_id:0,
//            'isdefault'=> $request->isdefault,
//        ];
//        return $data;
//    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ComMainModel::paginate($this->limit);
    }
}