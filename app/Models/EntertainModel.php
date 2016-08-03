<?php
namespace App\Models;

class EntertainModel extends BaseModel
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'id','title','genre','content','uid','sort','del','created_at','updated_at',
    ];

    public function staffs()
    {
        $entertainid = $this->id ? $this->id : 0;
        return StaffModel::where('entertain_id',$entertainid)->get();
    }
}