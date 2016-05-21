<?php
#before route, route, after route, before dispatch, dispatch, after dispatch, before run, run, after run
#适配器模式
class Request {

}

abstract class RunRequest {
    abstract function run ($request);
}


class Main extends RunRequest {
    public function run ($request) {
        echo "业务逻辑\n";
    }
}

abstract class DecorateRun extends RunRequest {
    protected $runRequest;
    public function __construct (RunRequest $runRequest) {
        $this->runRequest = $runRequest;
    }
}

class Log extends DecorateRun {
    public function run($request) {
        echo "记录日志\n";
        $this->runRequest->run($request);
    }
}

class Route extends DecorateRun {
    public function run($request) {
        echo "路由处理\n";
        $this->runRequest->run($request);
    }
}

class CheckParams extends DecorateRun {
    public function run($request) {
        echo "检查参数\n";
        $this->runRequest->run($request);
    }
}


class Auth extends DecorateRun {
    public function run($request) {
        echo "检查授权\n";
        $this->runRequest->run($request);
    }
}


class Init extends DecorateRun {
    public function run($request) {
        echo "初始化\n";
        $this->runRequest->run($request);
    }
}

$runObj = new Log(new Route(new CheckParams(new Auth(new Init(new Main())))));
$runObj->run(new Request());

