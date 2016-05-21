<?php
#功能封装，调用者和接收解耦
interface Command {
    public function exec();
}

class CommandA implements Command {
    private $receiver;
    public function __construct ($receiver) {
        $this->receiver = $receiver;
    }

    public function exec() {
        echo "命令类A\n";
        $this->receiver->doSomething();
    }
}

class CommandB implements Command {
    private $receiver;
    public function __construct ($receiver) {
        $this->receiver = $receiver;
    }

    public function exec() {
        echo "命令类B\n";
        $this->receiver->doSomething();
    }
}

class Receiver {
    public function doSomething() {
        echo "接收者执行一些操作\n";
    }

}


class Invoker {
    private $command;
    public function setCommand($command) {
        $this->command = $command;
        return $this;
    }

    public function action() {
        echo "调用者调用命令类执行任务，命令类调用接受者类完成任务\n";
        $this->command->exec();
    }
}


$commandAObj = new CommandA(new Receiver());
$commandBObj = new CommandB(new Receiver());
$invokerObj = new Invoker();
$invokerObj->setCommand($commandAObj)->action();
$invokerObj->setCommand($commandBObj)->action();
