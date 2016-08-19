<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignComSController extends DesignController
{
    /**
     * 会员后台：公司设计供应管理
     */

    protected $genre = 1;       //1企业供应，2企业需求，3个人供应，4个人需求

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '企业设计';
        $this->lists['func']['url'] = 'designComS';
        $this->lists['create']['name'] = '设计发布';
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($this->genre,$del=0,$cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/designComS',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.design.index', $result);
    }

    public function trash($cate=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($this->genre,$del=1,$cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/designComS/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.design.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'model'=> $this->model,
            'curr'=> $curr,
        ];
        return view('member.design.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['genre'] = $this->genre;
        $data['created_at'] = time();
        DesignModel::create($data);
        return redirect(DOMAIN.'member/designComS');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'lists'=> $this->lists,
            'data'=> DesignModel::find($id),
            'model'=> $this->model,
            'curr'=> $curr,
        ];
        return view('member.design.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        DesignModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/designComS');
    }
}