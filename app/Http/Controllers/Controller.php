<?php namespace App\Http\Controllers;

//use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Models\LinkModel;

abstract class Controller extends BaseController
{
//    use DispatchesCommands, ValidatesRequests;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 10;       //每页显示记录数
    protected $model;       //数据模型
    protected $uploadSizeLimit = 1024*1023*1;       //上传文件大小限制 1M
    protected $uploadVideoSizeLimit = 1024*1023*50;       //上传文件大小限制 50M
    protected $userid;
    protected $cid;
    protected $person;
    protected $company;
    protected $firmNum = 3;     //企业服务记录数
    protected $comPptNum = 3;     //企业宣传记录数
    protected $comJobNum = 5;     //企业工作记录数
    protected $sefLogo = '/assets/images/icon.png';        //本网站普通自己的logo地址
    protected $lists = [
        ''=> [
            'url'=> '',
            'name'=> '所有列表',
        ],
        'trash'=> [
            'url'=> 'trash',
            'name'=> '回收站',
        ],
        'create'=> [
            'url'=> 'create',
            'name'=> '创建作品',
        ],
        'edit'=> [
            'url'=> 'edit',
            'name'=> '修改作品',
        ],
        'show'=> [
            'url'=> 'show',
            'name'=> '查看详情',
        ],
        'category'=> [
            'url'=> '',
            'name'=> '',
        ],
        'func'=> [
            'url'=> '',
            'name'=> '',
        ],
    ];

    /**
     * 创建时间转换
     */
    public function createTime()
    {
        return $this->created_at ? date("Y年m月d日 H:i", $this->created_at) : '';
    }

    /**
     * 更新时间转换
     */
    public function updateTime()
    {
        return $this->updated_at ? date("Y年m月d日 H:i", $this->updated_at) : '';
    }
}