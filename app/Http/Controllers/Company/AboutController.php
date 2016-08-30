<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;

class AboutController extends BaseController
{
    /**
     * 企业页面 关于公司
     */

    //type：1公司简介，2公司历程，3新闻，4资讯
    protected $genre = 1;       //此处1代表关于公司

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFuncModel();
        $this->list['func']['name'] = '关于公司';
        $this->list['func']['url'] = 'about';
    }

    public function index($cid,$type=1)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $moduleid = $this->getModuleId($company['cid'],$this->genre);
        $result = [
//            'datas'=> $this->query($company['cid'],$moduleid,$type),
            'model'=> $this->model,
            'company'=> CompanyModel::find($company['cid']),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
            'type'=> $type,
        ];
        if (in_array($type,[1,2])) {
            $result['data'] = $this->query($company['cid'],$moduleid,$type);
        } elseif (in_array($type,[3,4])) {
            $result['datas'] = $this->query($company['cid'],$moduleid,$type);
        }
        return view('company.about.index', $result);
    }





    public function query($cid,$moduleid,$type)
    {
        if (in_array($type,[1,2])) {
            $datas = ComFuncModel::where('cid',$cid)
                ->where('module_id',$moduleid)
                ->where('type',$type)
                ->first();
        } elseif (in_array($type,[3,4])) {
            $limit = 20;
            $datas = ComFuncModel::where('cid',$cid)
                ->where('module_id',$moduleid)
                ->where('type',$type)
                ->paginate($limit);
            $datas->limit = $limit;
        }
        return $datas;
    }
}