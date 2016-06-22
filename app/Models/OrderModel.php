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
        'id','name','serial','genre','fromid','seller','sellerName','buyer','buyerName','number','status','money','realMoney1','realMoney2','realMoney3','realMoney4','isshow','del','created_at','updated_at',
    ];

    protected $genreNames = [
        //1创意供应，2创意需求，3分镜供应，4分镜需求，5视频供应，6视频需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
        1=>'创意供应',2=>'创意需求',3=>'分镜供应',4=>'分镜需求',5=>'视频供应',6=>'视频需求',
        7=>'娱乐供应',8=>'娱乐需求',9=>'演员供应',10=>'演员需求',11=>'租赁供应',12=>'租赁需求',
    ];

    //视频订单状态：1提交创意，2确定创意，3创意免费，4创意收费，5创意完成，6提交分镜，7确定分镜，8分镜免费，9分镜收费，10分镜完成，11进行协商，12开始制作，13分期收费，14效果协商，15二期收费，16确定成片，17三期收费，18出片交付保证播放，19尾款结清，20交易成功，21交易失败，（修改另外收费）
//    protected $statuss = [
//        1=>'提交创意','确定创意','创意免费','创意收费','创意完成','提交分镜','确定分镜','分镜免费','分镜收费',10=>'分镜完成',12=>'确定制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付','尾款结清','交易成功','交易失败',
//    ];

    //创意订单状态：1新的创意，2确定创意，3创意免费，4创意收费，5办理订单，6确认收到，11订单成功，12订单失败
    //分镜订单状态：1新的分镜，2确定分镜，3分镜免费，4分镜收费，5办理订单，6确认收到，11订单成功，12订单失败
    //视频制作订单状态：1新的样片，2确认制作，3分期收费，4效果协商，5二期收费，6确定成片，7三期收费，8出片交付，9尾款结清，10确认完成，11订单成功，12订单失败
    //创意、分镜订单流程
    protected $status1s = [1=>'新的订单','确认订单','订单免费','订单收费','办理订单','确认收到','订单成功','订单失败'];
    //视频订单流程
    protected $status2s = [
        1=>'新的片源','确认制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付','尾款结清','确认完成','订单成功','订单失败'
    ];
    //前台订单流程流程
    protected $status3s = [1=>'下订单',2=>'确定订单',3=>'进行协商',5=>'办理订单',6=>'确认收到',11=>'办理成功',12=>'办理失败'];

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
}