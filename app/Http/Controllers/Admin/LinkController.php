<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiLink;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '链接列表';
        $this->crumb['category']['name'] = '链接管理';
        $this->crumb['category']['url'] = 'link';
        $this->crumb['prefix'] = '链接';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/link';
        $datas = $this->query($pageCurr,$type);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'type' => $type,
        ];
        return view('admin.link.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'plinks'=> LinkModel::where('pid',0)->get(),      //得到父链接
            'types'=> $this->model['types'],
            'pics'=> $this->model->pic(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        LinkModel::create($data);
        return redirect(DOMAIN.'admin/link');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result =[
            'plinks'=> LinkModel::where('pid',0)->get(),      //得到父链接
            'pics'=> $this->model->pic(),
            'types'=> $this->model['types'],
            'data'=> LinkModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        LinkModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/link');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiLink = ApiLink::show($id);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiLink['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.link.show', $result);
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        if (!$data['title']) { $data['title'] = ''; }
        if (!$data['intro']) { $data['intro'] = ''; }
        $data = [
            'name'=> $data['name'],
            'cid'=> 0,      //0代表本网站
            'title'=> $data['title'],
            'type_id'=> $data['type_id'],
            'intro'=> $data['intro'],
        ];
        return $data;
    }

    public function query($pageCurr,$type)
    {
        $apiLink = ApiLink::index($this->limit,$pageCurr,0,$type,0);
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiLink::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}