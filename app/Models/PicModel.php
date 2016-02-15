<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PicModel extends Model
{
    protected $table = 'bs_pics';
    public $timestamps = false;
    protected $fillable = [
        'id','name','type_id','url','intro','created_at',
    ];

    /**
     * 关联类型表
     */
    public function type()
    {
        return $this->hasOne('App\Models\TypeModel', 'id', 'type_id');
    }
}