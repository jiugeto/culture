<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiLink;
use Illuminate\Http\Request;

class LinkController extends BaseController
{
    /**
     * 企业页面 链接控制
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '链接管理';
        $this->lists['func']['url'] = 'link';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'link';
        $apiLink = ApiLink::index($this->limit,$pageCurr,$this->cid,0,0);
        if ($apiLink['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiLink['data']; $total = $apiLink['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.link.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.link.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getLinkData($request);
        $apiLink = ApiLink::add($data);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'link');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiLink = ApiLink::show($id);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiLink['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.link.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getLinkData($request);
        $data['id'] = $id;
        $apiLink = ApiLink::modify($data);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'link');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiLink = ApiLink::show($id);
        if ($apiLink['code']!=0) {
            echo "<script>alert('".$apiLink['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiLink['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.link.show', $result);
    }




    public function getLinkData(Request $request)
    {
        return array(
            'name'  =>  $request->name,
            'display_way'   =>  $request->display_way,
            'cid'   =>  $this->cid,
            'type'  =>  $request->type,
            'title' =>  $request->title,
            'intro' =>  $request->intro,
            'link'  =>  $request->link,
            'pid'   =>  0,
        );
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