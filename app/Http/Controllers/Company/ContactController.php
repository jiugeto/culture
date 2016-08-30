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

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'company'=> CompanyModel::find($company['cid']),
            'data'=> $this->query($company['cid']),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
        ];
        return view('company.contact.index', $result);
    }

    public function query($cid)
    {
        $data = ComFuncModel::where('cid',$cid)->where('type',6)->first();
        $data->axis_x = $data->small?explode('|',$data->small)[0]:120;
        $data->axis_y = $data->small?explode('|',$data->small)[1]:30;
        return $data;
    }
}