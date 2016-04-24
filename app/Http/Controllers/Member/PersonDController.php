<?php
namespace App\Http\Controllers\Member;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\GoodsModel;

class PersonDController extends BaseGoodsController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 1;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '个人需求';
        $this->lists['func']['url'] = 'personD';
        $this->lists['create']['name'] = '发布需求';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/personD',
            'lists'=> $this->lists,
            'curr_list'=> '',
        ];
        return view('member.personSD.index', $result);
    }

    public function trash($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$this->type,$cate_id),
            'prefix_url'=> '/member/personD/trash',
            'lists'=> $this->lists,
            'curr_list'=> 'trash',
        ];
        return view('member.personSD.index', $result);
    }

    public function create()
    {
        $result = [
            'categorys'=> $this->model->categorys(),
            'pics'=> count($this->model->pics()) ? $this->model->pics() : [],
            'videos'=> count($this->model->videos()) ? $this->model->videos() : [],
            'lists'=> $this->lists,
            'curr_list'=> 'create',
        ];
        return view('member.personSD.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = date('Y-m-d', time());
        GoodsModel::create($data);
        return redirect('/member/personD');
    }

    public function edit($id)
    {
        $result = [
            'data'=> GoodsModel::find($id),
            'pics'=> count($this->model->pics()) ? $this->model->pics() : [],
            'videos'=> count($this->model->videos()) ? $this->model->videos() : [],
            'categorys'=> CategoryModel::all(),
            'lists'=> $this->lists,
            'curr_list'=> 'edit',
        ];
        return view('member.personSD.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->type,$id);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/member/personD');
    }

    public function show($id)
    {
        $result = [
            'data'=> GoodsModel::find($id),
            'pics'=> count($this->model->pics()) ? $this->model->pics() : [],
            'videos'=> count($this->model->videos()) ? $this->model->videos() : [],
            'lists'=> $this->lists,
            'curr_list'=> 'show',
        ];
        return view('member.personD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/personD');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/personD/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/member/personD/trash');
    }
}