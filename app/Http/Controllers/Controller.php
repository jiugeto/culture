<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\LinkModel;

abstract class Controller extends BaseController
{
    use DispatchesCommands, ValidatesRequests;

    protected $limit = 10;       //每页显示记录数
    protected $model;       //数据模型
    protected $uploadSizeLimit = 1024*1024*1;       //上传文件大小限制 1M

    /**
     * 顶部链接，头部菜单链接，左部菜单链接，底部链接
     */
    public function links()
    {
        return [
            'tops'=> $this->tops(),
            'headers'=> $this->headers(),
            'footers'=> $this->footers(),
            'menus'=> $this->menus(),
        ];
    }

    /**
     * 顶部链接：type_id==1
     */
    public function tops()
    {
        return LinkModel::where('type_id', 1)->get();
    }

    /**
     * 头部链接：type_id==2
     */
    public function headers()
    {
        return LinkModel::where('type_id', 2)->get();
    }

    /**
     * 底部链接：type_id==3
     */
    public function footers()
    {
        return LinkModel::where('type_id', 3)->get();
    }

    /**
     * 底部链接：type_id==4
     */
    public function menus()
    {
        return LinkModel::where('type_id', 4)->get();
    }
}