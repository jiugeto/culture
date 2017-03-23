<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Http\Request;

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
     * 上传方法，并处理文件
     */
    public function upload($file)
    {
        if($file->isValid()){
            $allowed_extensions = $this->suffix_img;
            if ($file->getClientOriginalExtension() &&
                !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                echo "<script>alert('你的图片格式不对！');history.go(-1);</script>";exit;
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/images/'.date('Y-m-d', time()).'/';
            $destinationPath = public_path().$folderName;
            $safeName        = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = rtrim(DOMAIN,'/').$folderName.$safeName;
            return $filePath;
        } else {
            return "没有图片！";
        }
    }

    /**
     * 只上传图片，返回图片地址
     */
    public function uploadOnlyImg(Request $request,$imgName='url_ori',$oldImgArr=[])
    {
        if($request->hasFile($imgName)){        //判断图片存在
            //去除老图片
            if ($oldImgArr) {
                foreach ($oldImgArr as $oldImg) { unlink($oldImg); }
            }
            foreach ($_FILES as $img) {
                if ($img['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert('上传的图片不能大于1M，请重新选择！');history.go(-1);</script>";exit;
                }
            }
            $file = $request->file($imgName);           //获取图片
            return $this->upload($file);
        } else {
            return '';
        }
    }
}