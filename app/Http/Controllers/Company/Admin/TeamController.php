<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComFunc;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    /**
     *  公司团队
     */

    protected $genre = 6;        //模块类型

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '团队编辑';
        $this->lists['func']['url'] = 'team';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN_C_BACK.'team';
        $rstFunc = $this->getFuncs($this->cid,$this->genre,$this->limit,$pageCurr,$prefix_url);
        $result = [
            'datas' => $rstFunc['datas'],
            'pagelist' => $rstFunc['pagelist'],
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->genre);
        $apiFunc = ApiComFunc::add($data);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'team');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiFunc = ApiComFunc::show($id);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiFunc['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->genre);
        $data['id'] = $id;
        $apiFunc = ApiComFunc::modify($data);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'team');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiFunc = ApiComFunc::show($id);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiFunc['data'],
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.team.show', $result);
    }
}