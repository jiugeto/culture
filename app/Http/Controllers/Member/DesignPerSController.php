<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignPerSController extends DesignController
{
    /**
     * 会员后台：个人设计供应管理
     */

    protected $genre = 3;       //1企业供应，2企业需求，3个人供应，4个人需求

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '个人设计';
        $this->lists['func']['url'] = 'designPerS';
        $this->lists['create']['name'] = '设计发布';
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($this->genre,$del=0,$cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/designPerS',
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
            'prefix_url'=> DOMAIN.'member/designPerS/trash',
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
        return redirect('/member/designPerS');
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
        return redirect(DOMAIN.'member/designPerS');
    }
}