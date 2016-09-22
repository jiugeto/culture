<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class ActionModel extends BaseModel
{
    protected $table = 'ba_action';
    protected $fillable = [
        'id','name','intro','namespace','controller_prefix','url','action','style_class','pid','sort','isshow','created_at','updated_at',
    ];

//    public function getSubUrls()
//    {
//        $actions = ActionModel::where('pid',$this->id)->get();
//        if (count($actions)) {
//            foreach ($actions as $action) {
//                $arr[] = $action->url;
//            }
//        }
//        return isset($arr) ? $arr : [];
//    }
}