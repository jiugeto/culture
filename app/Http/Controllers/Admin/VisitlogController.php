<?php
namespace App\Http\Controllers\Admin;

use App\Models\Company\VisitlogModel;

class VisitlogController extends BaseController
{
    /**
     * 系统后台公司页面的访问管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new VisitlogModel();
        $this->crumb['category']['name'] = '访问管理';
        $this->crumb['category']['url'] = 'visit';
        $this->crumb['']['name'] = '企业访问列表';
    }

    public function index($g=1,$uname='')
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($g,$uname),
            'prefix_url'=> DOMAIN.'admin/visit',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'g'=> $g,
            'uname'=> $uname,
        ];
        return view('admin.visitlog.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> VisitlogModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.visitlog.show', $result);
    }





    public function query($g,$uname)
    {
        if (!$uname) {
            $datas = VisitlogModel::orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($g==1 && $uname) {
            $datas = VisitlogModel::orderBy('id','desc')
                ->where('cname','like','%'.$uname.'%')
                ->paginate($this->limit);
        } elseif ($g==2 && $uname) {
            $datas = VisitlogModel::orderBy('id','desc')
                ->where('uname','like','%'.$uname.'%')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}