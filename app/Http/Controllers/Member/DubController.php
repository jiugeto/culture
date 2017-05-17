<?php
namespace App\Http\Controllers\Member;

class DubController extends BaseController
{
    /**
     * 会员后台配音管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '配音管理';
        $this->lists['func']['url'] = 'dub';
        $this->lists['create']['name'] = '添加样音';
    }

    public function index()
    {
    }

    public function create()
    {
    }
}