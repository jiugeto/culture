<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ActorModel extends BaseModel
{
    protected $table = 'bs_actors';
    protected $fillable = [
        'id','name','sex','realname','origin','education','school','hobby',
        'job','area','height','created_at','updated_at',
    ];

    protected $educations = [
        1=>'小学以下','小学','初中','高中','大学','研究生','博士','其他',
    ];
}