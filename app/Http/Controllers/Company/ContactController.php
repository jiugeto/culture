<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;

class ContactController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '联系方式';
        $this->list['func']['url'] = 'contact';
    }

    public function index()
    {
        $result = [
            'company'=> CompanyModel::find($this->cid),
            'data'=> $this->query(),
            'comMain'=> $this->getComMain(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'contact',
        ];
        return view('company.contact.index', $result);
    }

    public function query()
    {
        $data = ComFuncModel::where('cid',$this->cid)->where('type',6)->first();
        if (!$data) { $data = ComFuncModel::where('cid',0)->where('type',6)->first(); }
        $data->axis_x = $data->small?explode('|',$data->small)[0]:120;
        $data->axis_y = $data->small?explode('|',$data->small)[1]:30;
        return $data;
    }
}