<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;       //每页显示记录数
    protected $model;       //数据模型
    protected $suffix_img = ["png", "jpg", "gif", "bmp", "jpeg", "jpe"];       //允许上传的图片后缀
    protected $uploadSizeLimit = 1024*1023*1;       //上传文件大小限制 1M
    protected $uploadVideoSizeLimit = 1024*1023*50;       //上传文件大小限制 50M
    protected $userid = 0;
    protected $adminid = 0;
    protected $userType;
    protected $cid;
    protected $person;
    protected $company;
    protected $firmNum = 3;     //企业服务记录数
    protected $comPptNum = 3;     //企业宣传记录数
    protected $comJobNum = 5;     //企业工作记录数
    protected $sefLogo = '/assets/images/icon.png';        //本网站普通自己的logo地址
    protected $redisTime = 60 * 60 * 2;       //session在redis中缓存时长，单位秒，默认2小时
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

    public function __construct()
    {
        define("DOMAIN",getenv('DOMAIN'));
        define("PUB",getenv('PUB'));
    }

    /**
     * 接口分页处理
     */
    public function getPageList($total,$prefix_url,$limit,$pageCurr=1)
    {
        $currentPage = $pageCurr;               //当前页
        $lastPage = ceil($total / $limit);      //尾页
        //上一页路由
        if ($pageCurr<=1) {
            $previousPageUrl = $prefix_url;
        } else {
            $previousPageUrl = $prefix_url.'?page='.($pageCurr-1);
        }
        //下一页路由
        if ($pageCurr * $limit >= $total) {
            $nextPageUrl = $prefix_url.'?page='.$pageCurr;
        } else {
            $nextPageUrl = $prefix_url.'?page='.($pageCurr+1);
        }
        return array(
            'currentPage'   =>  $currentPage,
            'lastPage'      =>  $lastPage,
            'total'         =>  $total,
            'limit'         =>  $limit,
            'previousPageUrl'   =>  $previousPageUrl,
            'nextPageUrl'   =>  $nextPageUrl,
        );
    }

    /**
     * 图片上传
     */
    public function uploadOnlyImg($file,$path='')
    {
        //假如有，干掉老图片
        if ($path && file_exists($path)) { unlink($path); }
        //上传图片
        if($file->isValid()){
            $allowed_extensions = $this->suffix_img;
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return array('code'=>-2, 'msg'=>'你的图片格式不对！');
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/images/'.date('Y-m-d', time()).'/';
            $destinationPath = public_path().$folderName;
            $safeName        = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = rtrim(DOMAIN,'/').$folderName.$safeName;
            return array('code'=>0, 'data'=>$filePath);
        }
        return array('code'=>-1, 'msg'=>'图片上传错误！');
    }
}