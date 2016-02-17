<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ActionModel extends Model
{
    protected $table = 'ba_action';
    public $timestamps = false;
    protected $fillable = [
        'id','name','intro','namespace','controller_prefix','url','action','style_class','pid','created_at','updated_at',
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