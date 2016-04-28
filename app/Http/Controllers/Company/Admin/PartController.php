<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\GoodsModel;
use Illuminate\Http\Request;

class PartController extends BaseController
{
    /**
     * 企业开展后台，产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '花絮编辑';
        $this->lists['func']['url'] = 'part';
        $this->model = new GoodsModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($swl=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.part.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.part.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'categorys'=> $this->model->categorys(),
            'pics'=> $this->model->pics(),
            'videos'=> $this->model->videos(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.part.create', $result);
    }

    public function store(Request $request)
    {
       $data = $this->getData($request);
       $data['created_at'] = date('Y-m-d H:i:s', time());
       GoodsModel::create($data);
       return redirect('/company/admin/part');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'categorys'=> $this->model->categorys(),
            'pics'=> $this->model->pics(),
            'videos'=> $this->model->videos(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.part.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/company/admin/part');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'categorys'=> $this->model->categorys(),
            'pics'=> $this->model->pics(),
            'videos'=> $this->model->videos(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.part.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(array('del'=> 1));
        return redirect('/company/admin/part');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(array('del'=> 0));
        return redirect('/company/admin/part');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/company/admin/part');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $this->userid = 0;      //假如uid==0
        $uname = '';      //假如uname==''
        $data = [
            'name'=> $request->name,
            'genre'=> 2,     //1代表产品，2代表花絮
            'type'=> 4,     //1个人需求，2个人供应，3企业需求，4企业供应
            'cate_id'=> $request->cate_id,
            'intro'=> $request->intro,
            'title'=> $request->title,
            'pic_id'=> $request->pic_id,
            'video_id'=> $request->video_id,
            'uid'=> $this->userid,
            'uname'=> $uname,
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $this->userid = 0;     //假如默认值
        //说明：genre==1产品，2花絮；type==1个人需求，2个人供应，3企业需求，4企业供应
        $datas = GoodsModel::where('uid',$this->userid)
            ->where('del',$del)
            ->where(array('genre'=>2, 'type'=>4))
            ->paginate($this->limit);
        return $datas;
    }
}