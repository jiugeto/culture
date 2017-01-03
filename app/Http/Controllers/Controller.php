<?php namespace App\Http\Controllers;

//use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Controller extends BaseController
{
//    use DispatchesCommands, ValidatesRequests;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;       //每页显示记录数
    protected $model;       //数据模型
    protected $uploadSizeLimit = 1024*1023*1;       //上传文件大小限制 1M
    protected $uploadVideoSizeLimit = 1024*1023*50;       //上传文件大小限制 50M
    protected $userid = 0;
    protected $userType;
    protected $cid;
    protected $person;
    protected $company;
    protected $firmNum = 3;     //企业服务记录数
    protected $comPptNum = 3;     //企业宣传记录数
    protected $comJobNum = 5;     //企业工作记录数
    protected $sefLogo = '/assets/images/icon.png';        //本网站普通自己的logo地址
    protected $redisTime = 5;       //session在redis中缓存时长，单位分钟
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
        define("DOMAIN",strtoupper(getenv('DOMAIN')));
        define("PUB",strtoupper(getenv('PUB')));
        $this->setSessionInRedis();     //同步缓存中session
    }

    /**
     * 接口分页处理
     */
    public function getPageList($datas,$prefix_url,$limit,$pageCurr=1)
    {
        $currentPage = $pageCurr;                               //当前页
        $lastPage = ($pageCurr - 1) ? ($pageCurr - 1) : 1;      //上一页
        $total = count($datas);                                 //总记录数
        //上一页路由
        if ($pageCurr<=1) {
            $previousPageUrl = $prefix_url;
        } else {
            $previousPageUrl = $prefix_url.'?page='.($pageCurr-1);
        }
        //下一页路由
        if ($pageCurr * $limit >= count($datas)) {
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
     * 判断缓存中的session
     */
    public function setSessionInRedis()
    {
        //假如session中有，缓存中没有，则同步为有
        $userInfo=\Session::has('user');
        if (is_array($userInfo) && !\Redis::get('cul_session')) {
            $userInfo['cookie'] = $_COOKIE;
            \Redis::setex('cul_session',$this->redisTime*60,serialize($userInfo));
        }
        //假如session中没有，缓存中有，则同步为有
        if (!is_array($userInfo) && $cul_session=\Redis::get('cul_session')) {
            $cul_session = unserialize($cul_session);
            $cul_session['cookie'] = $_COOKIE;
            if ($cul_session['cookie']!=$_COOKIE) { echo 'no';exit; }
            \Session::put('user',$cul_session);
        }
        //更新session中的cookie值
        if (is_array($userInfo)) {
            $userInfo['cookie'] = $_COOKIE;
            \Redis::setex('cul_session',$this->redisTime*60,serialize($userInfo));
            \Session::put('user',$userInfo);
        }
    }
}