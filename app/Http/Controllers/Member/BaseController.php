<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */
    protected $limit = 10;       //每页显示记录数
    protected $model;       //数据模型
    protected $uploadSizeLimit = 1024*1024*1;       //上传文件大小限制 1M
}