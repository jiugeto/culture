<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ActionModel;
use App\Models\AdPlaceModel;

class AdPlaceController extends BaseController
{
    /**
     * 系统后台广告管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '广告位管理',
            'url'=> 'place',
        ],
    ];

    public function __construct()
    {
        $this->model = new AdPlaceModel();
    }

    public function index()
    {
        $datas = AdPlaceModel::where('del',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '广告位列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'datas'=> $datas,
            'crumb'=> $crumb,
            'prefix_url'=> '/admin/place',
        ];
        return view('admin.adplace.index', $result);
    }

    public function create()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'place/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'types'=> $this->model->getTypes(),
        ];
        return view('admin.adplace.create', $result);
    }

    public function store(Request $request){}

    public function edit($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '修改';
        $crumb['function']['url'] = 'place/edit';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'types'=> $this->model->type(),
            'data'=> AdPlaceModel::find($id),
        ];
        return view('admin.adplace.edit', $result);
    }

    public function update(Request $request, $id){}

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '详情';
        $crumb['function']['url'] = 'place/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> AdPlaceModel::find($id),
        ];
        return view('admin.adplace.show', $result);
    }





    /**
     * =================
     * 以下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
}