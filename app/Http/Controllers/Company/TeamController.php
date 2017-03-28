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
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiFunc = $this->getFuncs($cid,5,6,$pageCurr);
        $result = [
            'datas' => $apiFunc['datas'],
            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
        ];
        return view('company.team.index', $result);
    }
}