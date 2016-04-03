<?php
namespace App;

use Intervention\Image\ImageManagerStatic as Image;

class Tools
{
    /**
     * 工具类
     */

    /**
     * 数组中对象子id重组
     */
    public static function getChild($arrs,$pid=0){
        $list = array();
        foreach ($arrs as $v){
            if ($v->pid == $pid) {
                //找到子节点,继续找该子节点的后代节点
                $v->child = Tools::getChild($arrs,$v->id);
                $list[] = $v;
            }
        }
        return $list;
    }

    /**
     * 递归重组数组
     * 二维数组中增加层级level
     * @param array $arrs
     * @param int $pid
     * @param int $level
     * @return array $lixt
     */
    public static function category($arrs, $pid=0, $level=0){
        static $list = array();  //新数组，存储child
        foreach ($arrs as $v) {
            if ($v['parent_id'] == $pid) {
                //说明找到，将其保存到tree数组中
                $v['level'] = $level;
                $list[] = $v;
                //继续以当前节点为父节点，找它的子节点
                Tools::category($arrs,$v['id'],++$level);
                $level--;
            }
        }
        return $list;
    }

    /**
     * 重组数组，无限极分类
     * 数组变为多维数组
     * @param array $arr
     * @param int $parent_id
     * @return array $list
     */
    public static function childList($arr,$pid = 0){
        $list = array();
        foreach ($arr as $v){
            if ($v['parent_id'] == $pid) {
                //找到子节点,继续找该子节点的后代节点
                $v['child'] = Tools::childList($arr,$v['id']);
                $list[] = $v;
            }
        }
        return $list;
    }

    /**
     * 对象转为数组
     * @param array $arrs
     * @return array $array
     */
    public static function objToArr($arrs){
        $array = [];
        if(is_array($arrs)){
            foreach($arrs as $k=>$arr){
                if(is_object($arr)){
                    $array[$k] = (array)$arr;
                }
            }
        }
        return $array;
    }

    /**
     * 得到前一页面路由
     */
    public static function url()
    {
        //得到当前页面路由片段
        $urls = $_SERVER['REQUEST_URI'];
        $url_arr = explode('/',$urls);
        if ($url_arr[3]=='index') {
            $url = '';
        } else {
            $url = $url_arr[3];
        }
        return $url;
    }

    /**
     * 图片上传
     * @param string $file 表单中上传的文件
     * @return string $filePath 上传文件保存的路径
     */
    public static function upload($file)
    {
        //上传，并处理文件
//        dd($file->getRealPath());
        if($file->isValid()){
            $allowed_extensions = ["png", "jpg", "gif", "bmp", "jpeg", "jpe"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
//                return '你的图片格式不对：png，jpg，gif，bmp，jpeg，jpe。';
                $jump['module'] = '图片上传';
                $jump['msg'] = '你的图片格式不对：png，jpg，gif，bmp，jpeg，jpe。';
                return view('member.common.jump', compact('jump'));
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/images/'.date('Y-m-d', time()).'/';
            $destinationPath = public_path().$folderName;
            $safeName        = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = $folderName.$safeName;
            return $filePath;
        } else {
            echo "你的图片格式不对，请选择图片。";
            return view('admin.index');
        }
    }

    /**
     * 文件上传
     * @param string $file 表单中上传的文件
     * @return string $filePath 上传文件保存的路径
     */
    public static function uploadFile($file)
    {
        //上传，并处理文件
        if($file->isValid()){
            $allowed_extensions = ["txt", "doc", "xls", "zip", "rar", "ppt", "jnt"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
//                return '你的文件格式不对：txt，doc，xls，zip，rar，ppt，jnt。';
                $jump['module'] = '图片上传';
                $jump['msg'] = '你的文件格式不对：txt，doc，xls，zip，rar，ppt，jnt。';
                return view('member.common.jump', compact('jump'));
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/files/'.date('Y-m-d', time()).'/';
            $destinationPath = public_path().$folderName;
            $safeName        = uniqid().'.'.$extension;
            $file->move($destinationPath, $safeName);
            $filePath = $folderName.$safeName;
            return $filePath;
        } else {
            echo "你的文件格式不对，请重新选择。";
            return view('admin.index');
        }
    }

    /**
     * 缩略图处理
     * @param string $filePath 已上传的原始文件
     * @param int $width 缩略图宽度
     * @param int $height 缩略图高度
     * @return string '/'.$thumb_path 缩略图保存路径
     */
    public static function thumb($filePath, $width, $height){
        if ($filePath) {
            //得到文件名
            $url = explode('/',$filePath);
            $safeName = $url[count($url)-1];
            //重新拼接路径
            unset($url[0]);
            $url_new = implode('/',$url);
            $thumb_path = 'uploads/images/'.date('Y-m-d', time()).'/thumb_'.$safeName;
            Image::make($url_new)
                ->resize($width, $height)
                ->save($thumb_path);
            return '/'.$thumb_path;
        }
    }
}