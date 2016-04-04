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
    protected $uploadSizeLimit = 1024*1024*1;       //上传文件大小限制 1M
}