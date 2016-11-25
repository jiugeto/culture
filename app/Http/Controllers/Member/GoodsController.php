<?php
namespace App\Http\Controllers\Member;

use App\Models\CategoryModel;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class GoodsController extends BaseController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    protected $cateModels;
    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 1;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '视频管理';
        $this->lists['func']['url'] = 'goods';
        $this->lists['create']['name'] = '发布视频';
        $this->model = new GoodsModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->type),
            'prefix_url'=> DOMAIN.'member/goods',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$this->type),
            'prefix_url'=> DOMAIN.'member/goods/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'pics'=> $this->model->pics($this->userid),
            'videos'=> $this->model->videos($this->userid),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = time();
        GoodsModel::create($data);

        //插入搜索表
        $goodsModel = GoodsModel::where($data)->first();
        \App\Models\Home\SearchModel::change($goodsModel,2,'create');

        return redirect(DOMAIN.'member/goods');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->type);
        $data['updated_at'] = time();
        GoodsModel::where('id',$id)->update($data);

        //更新搜索表
        $goodsModel = GoodsModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($goodsModel,2,'update');


        return redirect(DOMAIN.'member/goods');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.goods.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/goods');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/goods/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/goods/trash');
    }

    /**
     * 查询方法
     */
    public function query($del=0,$type)
    {
        $datas =  GoodsModel::where('del',$del)
            ->where('type',$type)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 收集数据
     */
    public function getData(Request $request,$type)
    {
        $goods = [
            'name'=> $request->name,
            'type'=> $type,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'title'=> $request->title,
            'pic_id'=> $request->pic_id,
            'video_id'=> $request->video_id,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
        ];
        return $goods;
    }
}