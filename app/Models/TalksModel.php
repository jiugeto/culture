<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksModel extends BaseModel
{
    protected $table = 'bs_talks';
    protected $fillable = [
        'id','name','content','uid','read','click','follow','thank','share','report','collect','sort','del','created_at','updated_at',
    ];
}