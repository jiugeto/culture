<?php
namespace App\Models\Company;

use App\Models\BaseModel;
//use Illuminate\Database\Eloquent\Model;

class ComPptModel extends BaseModel
{
    protected $table = 'bs_com_ppts';
    protected $fillable = [
        'id','pic_id','cid','title','url','sort','sort2','isshow','isshow2','del','created_at','updated_at',
    ];

    public function pics()
    {
        return \App\Models\PicModel::all();
    }

    public function pic()
    {
        return $this->pic_id ? \App\Models\PicModel::find($this->id) : '';
    }

    public function company()
    {
        return $this->cid ? \App\Models\CompanyModel::find($this->cid) : '';
    }
}