<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFirmModel;

class FirmController extends BaseController
{
    /**
     * 企业后台服务
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '服务项目';
        $this->list['func']['url'] = 'firm';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'firm',
        ];
        return view('company.firm.index', $result);
    }

    public function query()
    {
        return ComFirmModel::where('cid',$this->cid)
                        ->where('isshow',1)
                        ->where('isshow2',1)
                        ->orderBy('sort','desc')
                        ->orderBy('sort2','desc')
                        ->get();
    }
}