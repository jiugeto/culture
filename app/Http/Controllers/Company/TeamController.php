<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComModuleModel;

class TeamController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '团队';
        $this->list['func']['url'] = 'team';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'team'=> $this->getModule($company['cid']),
            'datas'=> $this->query($company['cid']),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'curr'=> $this->prefix_url,
        ];
        return view('company.team.index', $result);
    }

    public function query($cid)
    {
        $limit = 10;
        $datas = ComFuncModel::where('cid',$cid)
                        ->where('type',4)
                        ->where('isshow',1)
                        ->paginate($limit);
        $datas->limit = $limit;
        return $datas;
    }

    public function getModule($cid)
    {
        if (count($this->query($cid))) { $firm = $this->query($cid)[0]; }
        return isset($firm) ? ComModuleModel::find($firm->module_id) : '';
    }
}