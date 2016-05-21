<?php
#路由 环境切换配置获取
interface  Route {
    function parse($pathInfo);
}

//默认路由
class DefaultRoute implements  Route {
    public function parse($pathInfo) {
        echo "默认路由\n";
    }
}

//rewrite路由
class RewriteRoute implements  Route {
    public function parse($pathInfo) {
        echo "rewrite路由\n";
    }
}

//正则路由
class RegexRoute implements    Route {
    public function parse($pathInfo) {
        echo "正则路由\n";
    }
}

class contextRequest {
    private $pathInfo;
    private $routeConf;
    public function setPathInfo($pathInfo) {
        $this->pathInfo = $pathInfo;
    }

    public function routeParse($routeObj) {
        $routeObj->parse($this->pathInfo );
    }
}

$contextRequest = new contextRequest();
$contextRequest->setPathInfo('/hello_world');

$routeConf = array (
            'default' => array(),
            'rewrite' => array (
                '/pl' => '/product/list',
                '/my_product_list' => '/product/list',
            ),
            'regex' => array(),
);

foreach ($routeConf as $rule => $conf) {
    $router = ucfirst($rule)."Route";
    $contextRequest->routeParse(new $router());
}




