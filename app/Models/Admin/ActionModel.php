<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ActionModel extends BaseModel
{
    protected $table = 'ba_action';
    protected $fillable = [
        'id','name','intro','namespace','controller_prefix','url','action','style_class','pid','sort','isshow','del','created_at','updated_at',
    ];

//    public function child()
//    {
//        return $this->hasMany($this, 'pid');
//    }
//
//    public function parent()
//    {
//        return $this->belongsTo($this, 'pid');
//    }
}