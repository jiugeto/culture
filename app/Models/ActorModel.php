<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class ActorModel extends BaseModel
{
    protected $table = 'bs_actors';
    protected $fillable = [
        'id','name','sex','realname','origin','education','school','hobby',
        'job','area','height','work','del','created_at','updated_at',
    ];
}