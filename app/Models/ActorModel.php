<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActorModel extends Model
{
    protected $table = 'bs_actors';
    protected $fillable = [
        'name','sex','realname','origin','education','school','hobby',
        'job','area','height','work','del','created_at','updated_at',
    ];
}