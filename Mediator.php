<?php
abstract class AbstractMediator {

}

class Mediator extends AbstractMediator {
    private $colleagueA;
    private $colleagueB;
    public function setColleagueA(ColleagueA $colleagueA) {
        $this->colleagueA = $colleagueA;
    }

    public function setColleagueB(ColleagueB $colleagueB) {
        $this->colleagueB = $colleagueB;
    }

    public function aPayB($money) {
        $this->colleagueA->setMoney($this->colleagueA->getMoney() - $money);
        $this->colleagueB->setMoney($this->colleagueB->getMoney() + $money);
    }

    public function bPayA($money) {
        $this->colleagueA->setMoney($this->colleagueA->getMoney() + $money);
        $this->colleagueB->setMoney($this->colleagueB->getMoney() - $money);
    }
}

abstract class Colleague {
    protected $mediator;
    private $money = 100;
    public function __construct(Mediator $mediator) {
        $this->mediator  = $mediator;
    }

    public function getMoney() {
        return $this->money;
    }

    public function setMoney($money) {
        $this->money = $money;
    }

}

class ColleagueA extends Colleague {
    public function payB($money) {
        echo "a给b ".$money."块钱\n";
        $this->mediator->aPayB($money);
    }

}

class ColleagueB extends Colleague {
    public function payA($money) {
        echo "b还给a ".$money."块钱\n";
        $this->mediator->bpayA($money);
    }

}

$mediator   = new Mediator();
$colleagueA = new ColleagueA($mediator);
$colleagueB = new ColleagueB($mediator);

$mediator->setColleagueA($colleagueA);
$mediator->setColleagueB($colleagueB);

echo "a现在有".$colleagueA->getMoney()." 块钱\n";
echo "b现在有".$colleagueB->getMoney()." 块钱\n";

$colleagueA->payB(50);

echo "a现在有".$colleagueA->getMoney()." 块钱\n";
echo "b现在有".$colleagueB->getMoney()." 块钱\n";


$colleagueB->payA(50);
echo "a现在有".$colleagueA->getMoney()." 块钱\n";
echo "b现在有".$colleagueB->getMoney()." 块钱\n";