<?php
namespace App\Http\Controllers\Company\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComFirmModel;

class FirmController extends BaseController
{
    /**
     * 企业后台 服务管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '服务编辑';
        $this->lists['func']['url'] = 'firm';
        $this->model = new ComFirmModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.index', $result);
    }

    public function create()
    {
        //企业服务限制
        $firms = ComFirmModel::where('cid',$this->cid)->get();
        if (count($firms)>$this->firmNum-1) {
            echo "<script>alert('已有服务记录，可以去修改！');history.go(-1);</script>";exit;
        }
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->model->pics(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFirmModel::create($data);
        return redirect('/company/admin/firm');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = ComFirmModel::find($id);
        $data->smalls = $data->small?explode('|',$data->small):[];
        $data->numSmall = $data->small?count($data->smalls):0;
        $result = [
            'data'=> $data,
            'pics'=> $this->model->pics(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.firm.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFirmModel::where('id',$id)->update($data);
        return redirect('/company/admin/firm');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = ComFirmModel::find($id);
        $data->smalls = $data->small?explode('|',$data->small):[];
        $result = [
            'data'=> $data,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
      return view('company.admin.firm.show', $result);
    }




    public function getData(Request $request)
    {
        if (!$request->intro) {
            echo "<script>alert('简介必填！');history.go(-1);</script>";exit;
        }
        if ($request->title) {
            if (!$request->detail) { echo "<script>alert('细节必填！');history.go(-1);</script>";exit; }
            if (!$request->small1) { echo "<script>alert('标题小字必填！');history.go(-1);</script>";exit; }
            //标题小字处理
            $firm = $request->all();
            for ($i=1;$i<$this->firmNum;$i++) {
                $smallname = 'small'.$i;
                if ($firm[$smallname]) { $smalls[] = $firm[$smallname]; }
            }
        }
        $data = [
            'name'=> $request->name,
            'cid'=> $this->cid,
            'intro'=> $request->intro,
            'title'=> $request->title,
            'pic_id'=> isset($request->pic_id)?$request->pic_id:0,
            'detail'=> $request->title?$request->detail:'',
            'small'=> isset($smalls)?implode('|',$smalls):'',
            'sort2'=> $request->sort2,
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    public function query()
    {
        $datas = ComFirmModel::where('cid',$this->cid)
            ->orderBy('sort2','desc')
            ->paginate($this->limit);
        if (!count($datas)) {
            $datas = ComFirmModel::where('cid',0)
                ->orderBy('sort2','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}