<?php
namespace App\Http\Controllers\Home;

use App\Models\RentModel;

class RentController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'rent';

    public function index($fromMoney=0,$toMoney=0)
    {
        //判断起始租金、结束租金
        if (!is_numeric($fromMoney) || !is_numeric($toMoney)) {
            echo "<script>alert('租金格式错误！');history.go(-1);</script>";exit;
        }
        $result = [
            'datas'=> $this->query($fromMoney,$toMoney),
            'ads'=> $this->ads(),
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'fromMoney'=> $fromMoney,
            'toMoney'=> $toMoney,
        ];
        return view('home.rent.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '详情';
        $data = RentModel::find($id);
        $result = [
            'lists'=> $this->list,
            'data'=> $data,
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $data->uid,
        ];
        return view('home.rent.show', $result);
    }




    public function query($fromMoney,$toMoney)
    {
        $datas = RentModel::where('genre',1)
            ->where('del',0)
            ->where('price','>',$fromMoney)
            ->where('price','<',$toMoney)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    public function ads()
    {
        //adplace_id==4，前台租赁页面右侧
        $limit = 3;
        $ads = \App\Models\Base\AdModel::where('uid',0)
            ->where('adplace_id',4)
            ->where('isuse',1)
            ->where('isshow',1)
            ->where('fromTime','<',time())
            ->where('toTime','>',time())
            ->orderBy('sort','desc')
            ->paginate($limit);
        $ads->limit = $limit;
        return $ads;
    }
}