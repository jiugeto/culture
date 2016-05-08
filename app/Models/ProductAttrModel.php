<?php
namespace App\Models;

class ProductAttrModel extends BaseModel
{
    protected $table = 'bs_products_attr';
    protected $fillable = [
        'id','name','productid','margin','padding','width','height','border','color','font_size','word_spacing','line_height','text_transform','text_align','background','position','left','top','overflow','opacity','intro','pid','islayer','del','created_at','updated_at',
    ];

    public function parents()
    {
        return ProductAttrModel::where('pid',0)->get();
    }

    public function parent()
    {
        return $this->pid ? ProductAttrModel::find($this->pid)->name : '已是顶级属性';
    }
}