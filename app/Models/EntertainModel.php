<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class EntertainModel extends BaseModel
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'id','title','genre','content','uid','sort','del','created_at','updated_at',
    ];
}