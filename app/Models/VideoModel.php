<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class VideoModel extends BaseModel
{
    protected $table = 'bs_videos';
    protected $fillable = [
        'id','uid','name','url','url2','intro','del','created_at','updated_at',
    ];
}