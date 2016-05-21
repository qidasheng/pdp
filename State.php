<?php
abstract class State {
    public function error() {echo "当前状态不能进行该操作\n";}
    public function create(Order $order) {$this->error();}
    public function pay(Order $order) {$this->error();}
    public function refund(Order $order) {$this->error();}
    public function cancel(Order $order) {$this->error();}
    public function delivery(Order $order) {$this->error();}
    public function receipt(Order $order) {$this->error();}

}


class Order {
    private $state;
    public  $defaultStateObj;
    public  $createStateObj;
    public  $payStateObj;
    public  $refundStateObj;
    public  $cancelStateObj;
    public  $deliveryStateObj;
    public  $receiptStateObj;
    public $orderInfo = array();
    public function __construct() {
        $this->state = new DefaultState();
        $this->createStateObj = new CreateState();
        $this->payStateObj    = new PayState();
        $this->refundStateObj = new RefundState();
        $this->cancelStateObj = new CancelState();
        $this->deliveryStateObj = new DeliveryState();
        $this->receiptStateObj = new ReceiptState();
    }

    public function setState(State $state) {
        $this->state = $state;
        $this->orderInfo['order_status'] = get_class($state);
    }

    public function getState() {
        return $this->state;
    }

    public function display() {
        echo "当前状态:".$this->orderInfo['order_status']."\n";
    }

    public function create() {
        $this->state->create($this);
    }


    public function pay() {
        $this->state->pay($this);
    }

    public function refund() {
        $this->state->refund($this);
    }

    public function cancel() {
        $this->state->cancel($this);
    }

    public function delivery() {
        $this->state->delivery($this);
    }

    public function receipt() {
        $this->state->receipt($this);
    }

}


//默认状态可以创建订单
class DefaultState extends  State {
    public function create(Order $order) {
        echo "*创建订单\n";
        $order->orderInfo = array(
            'title' => "一斤代码",
            'count' => 2,
            'total_price' => 8.88,
        );
        $order->setState($order->createStateObj);
        echo "商品名称:".$order->orderInfo['title']."\n";
        echo "购买数量:".$order->orderInfo['count']."\n";
        echo "支付金额:".$order->orderInfo['total_price']."\n";
    }
}

//创建状态可以支付或取消订单
class CreateState extends State {
    public function pay(Order $order) {
        echo "*支付订单\n";
        $order->setState($order->payStateObj);
    }
    public function cancel(Order $order) {
        echo "*取消订单\n";
        $order->setState($order->cancelStateObj);
    }
}

//支付状态可以退款，或发货
class PayState extends State {
    public function refund(Order $order) {
        echo "*退款\n";
        $order->setState($order->refundStateObj);
    }
    public function delivery(Order $order) {
        echo "*卖家发货\n";
        $order->setState($order->deliveryStateObj);
    }
}

//发货状态可以收货
class DeliveryState extends State {
    public function receipt(Order $order) {
        echo "*买家确认收货\n";
        $order->setState($order->receiptStateObj);
    }
}

//最终状态，没有其他操作可做
class ReceiptState extends State {}
class RefundState extends State {}
class CancelState extends State {}


$orderObj = new Order();
$orderObj->create();
$orderObj->display();

$orderObj->pay();
//$orderObj->cancel();
//$orderObj->refund();
$orderObj->display();

$orderObj->delivery();
$orderObj->display();

$orderObj->receipt();
$orderObj->display();

