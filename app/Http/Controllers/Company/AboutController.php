<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;

class AboutController extends BaseController
{
    /**
     * 企业页面 关于公司
     */

    //type：1公司简介，2公司历程，...
    protected $genre = 1;       //此处1代表关于公司

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '关于公司';
        $this->list['func']['url'] = 'about';
    }

    public function index($cid,$type=1)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $moduleid = $this->getModuleId($company['cid'],$this->genre);
        $result = [
            'data'=> $this->query($company['cid'],$moduleid,$type),
            'abouts'=> $this->getAbouts($company['cid'],$moduleid),
            'company'=> CompanyModel::find($company['cid']),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'curr'=> $this->prefix_url,
        ];
        return view('company.about.index', $result);
    }

    public function query($cid,$moduleid,$type)
    {
        return ComFuncModel::where('cid',$cid)
            ->where('module_id',$moduleid)
            ->where('type',$type)
            ->first();
    }

    public function getAbouts($cid,$moduleid)
    {
        return ComFuncModel::where('cid',$cid)
            ->where('module_id',$moduleid)
            ->get();
    }
}