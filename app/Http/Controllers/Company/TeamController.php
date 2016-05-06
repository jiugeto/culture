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

    public function index()
    {
        $result = [
            'team'=> $this->getModule(),
            'datas'=> $this->query(),
            'comMain'=> $this->getComMain(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'team',
        ];
        return view('company.team.index', $result);
    }

    public function query()
    {
        $datas = ComFuncModel::where('cid',$this->cid)
                        ->where('type',4)
                        ->where('isshow',1)
                        ->get();
        if (!count($datas)) {
            $datas = ComFuncModel::where('cid',0)
                ->where('type',4)
                ->where('isshow',1)
                ->get();
        }
        return $datas;
    }

    public function getModule()
    {
        if (count($this->query())) { $firm = $this->query()[0]; }
        return isset($firm) ? ComModuleModel::find($firm->module_id) : '';
    }
}