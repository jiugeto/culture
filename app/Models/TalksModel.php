<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksModel extends BaseModel
{
    protected $table = 'bs_talks';
    protected $fillable = [
        'id','name','content','uid','read','click','thank','sort','del','created_at','updated_at',
    ];

    public function follow()
    {
        return TalksFollowModel::where('talkid',$this->id)->get();
    }

    public function share()
    {
        return TalksShareModel::where('talkid',$this->id)->get();
    }

    public function report()
    {
        return TalksReportModel::where('talkid',$this->id)->get();
    }

    public function collect()
    {
        return TalksCollectModel::where('talkid',$this->id)->get();
    }

    public function followStr()
    {
        if ($this->follow()) {
            foreach ($this->follow() as $v) { $follows = $v->followid; }
        }
        return isset($follows) ? implode(',',$follows) : '';
    }

    public function shareStr()
    {
        if ($this->share()) {
            foreach ($this->share() as $v) { $shares = $v->shareid; }
        }
        return isset($shares) ? implode(',',$shares) : '';
    }

    public function reportStr()
    {
        if ($this->report()) {
            foreach ($this->report() as $v) { $reports = $v->reportid; }
        }
        return isset($reports) ? implode(',',$reports) : '';
    }

    public function collectStr()
    {
        if ($this->collect()) {
            foreach ($this->collect() as $v) { $collects = $v->collectid; }
        }
        return isset($collects) ? implode(',',$collects) : '';
    }
}