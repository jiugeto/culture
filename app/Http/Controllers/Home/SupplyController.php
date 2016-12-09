<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiUser\ApiCompany;
use App\Models\Base\BaseModel;

class SupplyController extends BaseController
{
    /**
     * 网站前台供应企业
     */

    protected $curr = 'supply';
    /**
     *  3普通企业，5广告公司，6影视公司，7租赁公司
     */
    protected $genres = [
        3=>'普通企业',5=>'广告公司','影视公司','租赁公司',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=0)
    {
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'supply';
        $result = [
            'datas'=> $this->query($genre,$pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'genres'=> $this->genres,
            'areaModel'=> new BaseModel(),
            'ads'=> $this->ads(),
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'genre'=> $genre,
        ];
        return view('home.supply.index', $result);
    }





    public function query($genre,$pageCurr,$prefix_url)
    {
        $rst = ApiCompany::getCompanyList($this->limit,$pageCurr,$genre);
        $datas = $rst['code']==0?$rst['data']:[];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

    public function ads()
    {
        //adplace_id==2，前台供应页面右侧
        $limit = 2;
        $ads = \App\Models\Base\AdModel::where('uid',0)
            ->where('adplace_id',2)
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