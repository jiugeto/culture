<?php
namespace App\Http\Controllers\Person;

use App\Models\DesignModel;
use App\Models\GoodsModel;
use App\Models\MessageModel;
use App\Models\OrderModel;
use App\Models\OrderProductModel;
use App\Models\PicModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class SpaceController extends BaseController
{
    /**
     * 个人后台个人空间
     */

    protected $curr = 'curr';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($g_type=0,$p_type=1,$d_type=1)
    {
        $result = [
            'links'=> $this->links,
            'user'=> $this->user(),
            'pics'=> $this->pics(),
            'goods'=> $this->goods($g_type),
            'products'=> $this->products($p_type),
            'messages'=> $this->messages(),
            'designs'=> $this->designs($d_type),
            'g_type'=> $g_type,
            'p_type'=> $p_type,
            'd_type'=> $d_type,
            'curr'=> $this->curr,
        ];
        return view('person.space.index', $result);
    }





    public function user()
    {
        $uid = $this->userid ? $this->userid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    public function pics()
    {
        $uid = $this->userid ? $this->userid : 0;
        $picModels = PicModel::where('uid',$uid)->paginate(9);
        return $picModels ? $picModels : [];
    }

    /**
     * 发布的作品
     */
    public function goods($g_type)
    {
        if ($g_type) {
            $datas = GoodsModel::where('del',0)
                ->where('genre',1)          //产品系列
                ->where('type',$g_type)
                ->where('isshow',1)
                ->where('isshow2',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(10);
        } else {
            $datas = GoodsModel::where('del',0)
                ->where('genre',1)          //产品系列
                ->whereIn('type',[2,4])     //供应
                ->where('isshow',1)
                ->where('isshow2',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(10);
        }
        return $datas;
    }

    /**
     * 在线创作的作品
     */
    public function products($p_type=1)
    {
        if ($p_type==1) {
            $buyerIds = array();
            $buyers = OrderProductModel::where('del',0)
                ->where('buyer',$this->userid)
                ->where('isshow',1)
                ->get();
            if (count($buyers)) {
                foreach ($buyers as $buyer) {
                    $buyerIds[] = $buyer->id;
                }
            }
            $datas = ProductModel::where('del',0)
                ->whereIn('uid',$buyerIds)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(10);
        } else if ($p_type==2) {
            $datas = ProductModel::where('del',0)
                ->where('uid',$this->userid)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(10);
        }
        return $datas;
    }

    /**
     * 留言板，消息
     */
    public function messages()
    {
        return MessageModel::where('del',0)
            ->where('accept',$this->userid)
            ->orderBy('id','desc')
            ->paginate(2);
    }

    /**
     * 设计
     */
    public function designs($d_type=1)
    {
        if ($d_type==1) {
            $buyerIds = array();
            $buyers = OrderModel::where('del',0)
                ->whereIn('genre',[1,2])
                ->where('buyer',$this->userid)
                ->where('isshow',1)
                ->get();
            if (count($buyers)) {
                foreach ($buyers as $buyer) {
                    $buyerIds[] = $buyer->id;
                }
            }
            $datas = DesignModel::where('del',0)
                ->whereIn('uid',$buyerIds)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(4);
        } else if ($d_type==2) {
            $datas = DesignModel::where('del',0)
                ->where('uid',$this->userid)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate(4);
        }
        return $datas;
    }
}