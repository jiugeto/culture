<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class EntertainModel extends BaseModel
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'id','title','content','uid','del','created_at','updated_at',
    ];
}