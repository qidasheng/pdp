<?php
abstract class Subject {
    public $name;
    public function __construct($name) {
        $this->name = $name.PHP_EOL;
    }

    abstract function accept($visitor);

}


class SubjectA extends Subject {

    public function accept($visitor) {
        $visitor->visitA($this);
    }
}


class SubjectB extends Subject {

    public function accept($visitor) {
        $visitor->visitB($this);
    }
}


abstract class Visitor{
    abstract function visitA(Subject $subject);
    abstract function visitB(Subject $subject);

}


class FirstVisitor extends Visitor {
    public function visitA (Subject $subject) {
        echo "First visit A ".$subject->name ."\n";
    }

    public function visitB (Subject $subject) {
        echo "First visit B ".$subject->name ."\n";
    }
}

class SecondVisitor extends Visitor {
    public function visitA (Subject $subject) {
        echo "Second visit A ".$subject->name ."\n";
    }

    public function visitB (Subject $subject) {
        echo "Second visit B ".$subject->name ."\n";
    }
}


class Doer {
    private $subjects = array();
    public function addSubject(Subject $subject) {
            $this->subjecs[] = $subject;
    }

    public function accept(Visitor $visitor) {
        foreach ($this->subjecs as $subject) {
            $subject->accept($visitor);
        }
    }
}

$doerObj = new Doer();
$doerObj->addSubject(new SubjectA('张三'));
$doerObj->addSubject(new SubjectB('李四'));

$doerObj->accept(new FirstVisitor());
$doerObj->accept(new SecondVisitor());