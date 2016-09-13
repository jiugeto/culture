<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\VisitlogModel;
use App\Models\Company\ComMainModel;

class VisitlogController extends BaseController
{
    /**
     * 系统后台公司页面的访问管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new VisitlogModel();
        $this->crumb['']['name'] = '企业功能列表';
        $this->crumb['category']['name'] = '访问管理';
        $this->crumb['category']['url'] = 'visit';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/visit',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.visitlog.index', $result);
    }





    public function query()
    {
        $datas = VisitlogModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}