<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiComModule;

class AboutController extends BaseController
{
    /**
     * 企业页面 关于公司
     */

    //genre：1公司简介，2公司历程，3新闻，4资讯

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '关于公司';
        $this->list['func']['url'] = 'about';
    }

    public function index($cid,$genre=1)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiModule = ApiComModule::getModuleByGenre($cid,$genre);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        $apiFunc = $this->getFuncs($cid,5,$genre,$pageCurr);
        $result = [
            'modules' => $apiModule['data'],
            'datas' => $apiFunc['datas'],
            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
            'genre' => $genre,
        ];
        return view('company.about.index', $result);
    }
}