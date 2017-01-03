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

    //父id：pid
    public static function childList2($obj,$pid = 0){
        $list = array();
        foreach ($obj as $v){
            if ($v->pid == $pid) {
                //找到子节点,继续找该子节点的后代节点
                $v->child = Tools::childList2($obj,$v->id);
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
            echo "你的图片格式不对，请选择图片。";exit;
//            return view('admin.index');
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
            echo "你的文件格式不对，请重新选择。";exit;
//            return view('admin.index');
        }
    }

    /**
     * 文件上传
     * @param string $file 表单中上传的文件
     * @return string $filePath 上传文件保存的路径
     */
    public static function uploadVideo($file)
    {
        //上传，并处理文件
        if($file->isValid()){
            $allowed_extensions = ["flv", "mpeg4", "mkv", "avi", "rm", "wmv", "mov"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
//                return '你的文件格式不对：txt，doc，xls，zip，rar，ppt，jnt。';
                $jump['module'] = '图片上传';
                $jump['msg'] = '你的文件格式不对：flv，mpeg4，mkv，avi，rm，wmv，mov。';
                return view('member.common.jump', compact('jump'));
            }
            $extension       = $file->getClientOriginalExtension() ?: 'png';
            $folderName      = '/uploads/videos/'.date('Y-m-d', time()).'/';
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
    public static function thumb($filePath, $width, $height)
    {
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

    /**
     * 图片上传处理，返回上传后的图片地址链接
     */
    public static function getAddrByUploadImg($request,$uploadSizeLimit)
    {
        if($request->hasFile('url_ori')){  //判断文件存在
            //验证图片大小
            foreach ($_FILES as $pic) {
                if ($pic['size'] > $uploadSizeLimit) {
                    echo "<script>alert('对不起，你上传的文件大于1M，请重新选择');history.go(-1);</script>";exit;
                }
            }
            $file = $request->file('url_ori');  //获取文件
            return Tools::upload($file);
//            $config = [
//                'fileField' => 'url_ori',    //文件域字段名
//                'allowFiles'=> $this->pic_suffixs,   //允许上传的文件后辍
//                'maxSize'   => $this->uploadSizeLimit, //允许上传文件的大小5M 单位 b
//                'nameFormat'=> $this->pic_path,
//            ];
//            $rst = Uploader::save($config, $request);
//            if ($rst['state']=='SUCCESS') { $data['url_ori'] = $rst['url']; }
//            else { echo "<script>alert('图片上传错误，".$rst['state']."！');history.go(-1);</script>";exit; }
        } else {
            return false;
        }
    }

    /**
     * 定义一个方法，获取用户端ip
     */
    public static function getIp()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR")) {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR")) {
            $ip = getenv("REMOTE_ADDR");
        } else {
            $ip = "";
        }
        return $ip;
    }

    /**
     * 把数据的对象格式转换成数据格式
     * @param $object
     * @return mixed
     */
    public static function objectToArray(&$object) {
        $object =  json_decode(json_encode( $object), true);
        return  $object;
    }

    /**
     * 由ip获得所在城市
     */
    public static function getCityByIp($ip='')
    {
        $address = '';
        if ($ip && substr($ip,0,7)!='192.168') {
            $key = 'Tj1ciyqmG0quiNgpr0nmAimUCCMB5qMk';      //自己申请的百度地图api的key
            $curl = new \Curl\Curl();
            $apiUrl = 'http://api.map.baidu.com/location/ip';
            $curl->post($apiUrl, array(
                'ak'=> $key,
                'ip'=> $ip,
            ));
            $response = $curl->response;
            $response = \App\Tools::objectToArray($response);
            if ($response['status']==0) {
                $address = $response['content']['address'];
            }
        } elseif ($ip && substr($ip,0,7)=='192.168') {
            $address = '浙江省 杭州市 滨江区';
        } elseif (!$ip) {
            $address = '未知';
        }
        return $address;
    }
}