<?php
#模式模式，模板类定义执行步骤,模板实现部分公共方法提供代码复用，模板类定义具体类、抽象方法、钩子方法，子类实现部分方法，钩子方法用来决定要不要做某些事
abstract class AbstractController {

    public function init() {  //初始化

    }

    public function Log() {
        echo "记录日志\n";
    }

    final function checkParams() {
        echo "参数校验\n";
    }

    public function needAuth() {  //hook
        return true;
    }

    final function checkAuth() {
        echo "需要权限校验\n";
    }

    abstract function action(); //执行具体控制器逻辑

    final function run() {
        //决定执行步骤
        $this->init();
        $this->log();
        $this->checkParams();
        if ($this->needAuth()) {  //hook决定是否执行某个步骤
            $this->checkAuth();
        }
        $this->action();

    }

}

class HelloController extends  AbstractController {
    public function init() {
        echo "Hello 初始化\n";
    }

    public function action() {
        echo "Hello 执行\n";
    }
}


class WorldController extends  AbstractController {
    //World不需要权限验证
    public function needAuth() {
        return false;
    }

    public function init() {
        echo "World 初始化\n";
    }



    public function action() {
        echo "World 执行\n";
    }
}

$controllerObj = new HelloController();
$controllerObj->run();

$controllerObj = new WorldController();
$controllerObj->run();


