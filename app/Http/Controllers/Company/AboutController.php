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

    protected $moduleid;
    protected $genre = 1;       //此处1代表关于公司

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '关于公司';
        $this->list['func']['url'] = 'about';
        $this->moduleid = $this->getModuleId($this->genre);
    }

    public function index($type=1)
    {
        $result = [
            'abouts'=> $this->getAbouts(),
            'company'=> CompanyModel::find($this->cid),
            'data'=> $this->query($type),
            'comMain'=> $this->getComMain(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'about',
        ];
        return view('company.about.index', $result);
    }

    public function query($type)
    {
        $data = ComFuncModel::where('cid',$this->cid)->where('module_id',$this->moduleid)->where('type',$type)->first();
        if (!$data) {
            $data = ComFuncModel::where('cid',0)->where('module_id',$this->moduleid)->where('type',$type)->first();
            $about = [
                'name'=> $data->name,
                'cid'=> $this->cid,
                'module_id'=> 1,
                'type'=> $type,
                'genre'=> $data->genre,
                'pic_id'=> $data->pic_id,
                'intro'=> $data->intro,
                'small'=> $data->small,
            ];
            ComFuncModel::create($about);
        }
        return ComFuncModel::where('cid',$this->cid)->where('module_id',$this->moduleid)->where('type',$type)->first();
    }

    public function getAbouts()
    {
        return ComFuncModel::where('cid',$this->cid)->where('module_id',$this->moduleid)->get();
    }
}