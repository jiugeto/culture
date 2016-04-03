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

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/opinions',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.index', $result);
    }

    public function query()
    {
        $datas = OpinionModel::where('del',0)->paginate($this->limit);
        return $datas;
    }
}