<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Base\VisitlogModel;
use App\Models\Company\ComMainModel;

class VisitlogController extends BaseController
{
    /**
     * 公司后台访问统计
     */

    protected $vsitRate;       //访问频率

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '综合应用';
        $this->lists['category']['url'] = 'general';
        $this->lists['func']['name'] = '访问管理';
        $this->lists['func']['url'] = 'visit';
        $this->model = new VisitlogModel();
        //公司页面访问日志刷新频率
        $comMainModel = ComMainModel::where('cid',$this->cid)->first();
        $this->visitRate = $comMainModel->visitRate;
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'company/admin/visit',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
            'visitRate'=> $this->visitRate,
        ];
        return view('company.admin.visitlog.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> VisitlogModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
            'visitRate'=> $this->visitRate,
        ];
        return view('company.admin.visitlog.show', $result);
    }





    public function query()
    {
        $datas = VisitlogModel::where('cid',$this->cid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}