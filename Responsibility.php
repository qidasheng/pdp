<?php
#Chain Of Responsibility (职责链模式)
interface HandleRequest {
    public function handleRequest($request);
}

abstract class AbstractHandleRequest implements HandleRequest {
    protected $nextHandler;
    public function __construct($nextHandler = '') {
        if ($nextHandler != '') {
            $this->nextHandler = $nextHandler;
        }
    }
}

class FirstHandler extends  AbstractHandleRequest  {

    public function handleRequest($request) {
        if ($request->type == 1) {
            echo "FirstHandler do something\n";
        } else {
            $this->nextHandler->handleRequest($request);
        }
    }
}


class SecondHandler extends  AbstractHandleRequest  {

    public function handleRequest($request) {
        if ($request->type == 2) {
            echo "SecondHandler do something\n";
        } else {
            $this->nextHandler->handleRequest($request);
        }
    }
}


class LastHandler extends  AbstractHandleRequest  {
    public function handleRequest($request) {
        echo "LastHandler do something\n";

    }
}

class Request {
    public $type = 0;
    public function __construct($type) {
        $this->type = $type;
    }
}


$lastObj = new LastHandler();
$secondObj = new SecondHandler($lastObj);
$firstObj  = new FirstHandler($secondObj);
$firstObj->handleRequest(new Request(3));
$firstObj->handleRequest(new Request(2));
$firstObj->handleRequest(new Request(1));
