<?php
abstract class Program {
    abstract function run();
}

class PhpProgram extends Program {
    private $name = "PHP";
    public function run() {
        echo "运行".$this->name."代码\n";
    }
}

class JavaProgram extends Program {
    private $name = "JAVA";
    public function run() {
        echo "运行".$this->name."代码\n";
    }
}


abstract class System {
    protected $program;
    abstract function start();
    public function setProgram(Program $program) {
        $this->program = $program;
    }
}

class Windows extends System{
    private $name = "Windows";

    public function start() {
        echo "启动".$this->name."\n";
        $this->program->run();
    }

}

class Linux extends System{
    private $name = "Linux";
    public function start() {
        echo "启动".$this->name."\n";
        $this->program->run();
    }
}


abstract class Person {
    abstract function bootSys();
    protected $system;
    public function setSystem(System $system) {
        $this->system = $system;
    }
}

class Phper extends Person {
    private $name = "PHP程序员";
    public function bootSys() {
        echo $this->name."\n";
        $this->system->start();
    }

}

class Javaer extends Person {
    private $name = "JAVA程序员";
    public function bootSys() {
        echo $this->name."\n";
        $this->system->start();
    }
}

$program = new PhpProgram();
$linux = new Linux();
$linux->setProgram($program);

$phper = new Phper();
$phper->setSystem($linux);
$phper->bootSys();
