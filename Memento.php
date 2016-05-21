<?php
class Memento  {
    private $code = array();
    public function __construct($code) {
        $this->code = $code;
    }

    public function getCode() {
        return $this->code;
    }
}



class Programmer {
    private $code = array();

    public function  createMemento() {
        return new Memento($this->code);
    }


    public function restoreCode(Memento $memento) {
         $this->setCode($memento->getCode());
    }

    public function coding($code) {
        $this->code[] = $code;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        return $this->code = $code;
    }
}


class Caretaker {
    private $memento;
    public function setMemento($memento) {
        $this->memento = $memento;
    }
    public function getMemento() {
        return $this->memento;
    }
}

$programmer = new Programmer();
$programmer->coding('I am phper');
$programmer->coding('hello world');
print_r($programmer->getCode());

$caretaker = new Caretaker();
$caretaker->setMemento($programmer->createMemento());

$programmer->coding('……');
print_r($programmer->getCode());

$programmer->restoreCode($caretaker->getMemento());
print_r($programmer->getCode());