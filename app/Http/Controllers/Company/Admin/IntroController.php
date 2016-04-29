<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComInfoModel;
use Illuminate\Http\Request;

class IntroController extends BaseController
{
    /**
     *  公司简介
     */

    protected $type = 1;        //1代表公司介绍

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '公司简介';
        $this->lists['func']['url'] = 'intro';
    }

    public function index()
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> $this->query($this->type),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.intro.index', $result);
    }

    public function edit()
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> $this->query($this->type),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.intro.edit', $result);
    }

    public function update(){}





    public function query($type)
    {
        return ComInfoModel::where('cid',$this->cid)->where('type',$type)->first();
    }
}