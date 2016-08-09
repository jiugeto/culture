<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OrderModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders';
    protected $fillable = [
        'id','name','serial','genre','fromid','seller','sellerName','buyer','buyerName','number','status','remarks','money','realMoney1','realMoney2','realMoney3','realMoney4','isshow','del','created_at','updated_at',
    ];

    protected $genreNames = [
        //1创意供应，2创意需求，3分镜供应，4分镜需求，5视频供应，6视频需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
        1=>'创意供应',2=>'创意需求',3=>'分镜供应',4=>'分镜需求',5=>'视频供应',6=>'视频需求',
        7=>'娱乐供应',8=>'娱乐需求',9=>'演员供应',10=>'演员需求',11=>'租赁供应',12=>'租赁需求',
    ];

    //创意订单状态：1申请创意，2确定创意，3拒绝创意，4创意免费，5创意收费，6办理订单，7确认收到，12订单成功，13订单失败
    //分镜订单状态：1申请分镜，2确定分镜，3拒绝分镜，4分镜免费，5分镜收费，6办理订单，7确认收到，12订单成功，13订单失败
    //视频制作订单状态：1新的样片，2确认制作，3拒绝制作，4分期收费，5效果协商，6二期收费，7确定成片，8三期收费，9出片交付，10尾款结清，11确认完成，12订单成功，13订单失败
    //创意、分镜订单流程
    protected $status1s = [1=>'新的订单','确认订单','拒绝订单','订单免费','订单收费','办理订单','确认收到',12=>'订单成功','订单失败'];
    //视频订单流程
    protected $status2s = [
        1=>'新的片源','确认制作','拒绝制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付','尾款结清','确认完成','订单成功','订单失败'
    ];
    //前台订单流程
    protected $status3s = [1=>'下订单',2=>'确定订单',3=>'拒绝订单',4=>'进行协商',6=>'办理订单',7=>'确认收到',12=>'办理成功',13=>'办理失败'];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genreNames) ? $this->genreNames[$this->genre] : '无';
    }

    public function status()
    {
        if (in_array($this->genre,[1,2,3,4])) {
            $status = array_key_exists($this->status,$this->status1s)?$this->status1s[$this->status]:'无';
        } elseif (in_array($this->genre,[5,6])) {
            $status = array_key_exists($this->status,$this->status2s)?$this->status2s[$this->status]:'无';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status,$this->status3s)?$this->status3s[$this->status]:'无';
        }
        return isset($status) ? $status : '无';
    }

    public function statusbtn()
    {
        if (in_array($this->genre,[1,2,3,4])) {
            $status = array_key_exists($this->status+1,$this->status1s)?$this->status1s[$this->status+1]:'';
        } elseif (in_array($this->genre,[5,6])) {
            $status = array_key_exists($this->status+1,$this->status2s)?$this->status2s[$this->status+1]:'';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status+1,$this->status3s)?$this->status3s[$this->status+1]:'';
        }
        return isset($status) ? $status : '';
    }

    /**
     * 订单来源的数据
     */
    public function getModel()
    {
        if (in_array($this->genre,[1,2])) { $model = IdeasModel::find($this->fromid); }
        elseif (in_array($this->genre,[3,4])) { $model = StoryBoardModel::find($this->fromid); }
        elseif (in_array($this->genre,[5,6])) { $model = GoodsModel::find($this->fromid); }
        return isset($model) ? $model : '';
    }

    /**
     * 发布方名称
     */
    public function getSellName()
    {
        $userModel = $this->getUser($this->seller);
        return $userModel ? $userModel->username : '';
    }

    /**
     * 申请方名称
     */
    public function getBuyName()
    {
        $userModel = $this->getUser($this->buyer);
        return $userModel ? $userModel->username : '';
    }

    /**
     * 由uid得到 用户信息
     */
    public function getUser($uid)
    {
        $userInfo = UserModel::find($uid);
        return $userInfo ? $userInfo : '';
    }
}