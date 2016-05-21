<?php
interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

interface Observer {
    public function update(Subject $subject);
}

class MySubject implements Subject {
    private $observers;
    private $name;
    public function __construct($name) {
        $this->observers = new SplObjectStorage();
        $this->name = $name;
    }

    public function attach(Observer $observer) {
        $this->observers->attach($observer);
    }

    public function detach(Observer $observer) {
        $this->observers->detach($observer);
    }
    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}


class Observer1 implements  Observer {
    public function update(Subject $subject) {
        echo "记日志\n";
    }
}

class Observer2 implements  Observer {
    public function update(Subject $subject) {
        echo "发邮件\n";
    }
}

class Observer3 implements  Observer {
    public function update(Subject $subject) {
        echo "加统计\n";
    }
}

$mySubject = new MySubject('登录');
$mySubject->attach(new Observer1());
$mySubject->attach(new Observer2());
$mySubject->attach(new Observer3());
$mySubject->notify();