<?php
class Subject {
    public  function methodA() {
        echo "执行方法A\n";
    }
}

class ProxySubject {
    private $subject;
    public function __construct() {

    }

    private function lazyLoad() {
        echo "延迟加载\n";
        if (!$this->subject instanceof ProxySubject) {
            $this->subject = new Subject();
        }
        return $this->subject;
    }

    public function methodA() {
        $this->lazyLoad()->methodA();
    }

}

$proxySubject = new ProxySubject();
$proxySubject->methodA();
