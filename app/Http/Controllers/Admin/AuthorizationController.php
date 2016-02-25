<?php
namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
//use App\Models\DesignModel;

class AuthorizationController extends BaseController
{
    /**
     * 系统后台所有细分功能的权限控制统一管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '功能权限',
            'url'=> 'authorization',
        ],
    ];

    public function index()
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '功能权限列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
        ];
        return view('admin.authorization.index', $result);
    }
}