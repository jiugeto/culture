<?php
namespace App;

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
}