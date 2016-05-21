<?php
#适配器模式：接口转化，兼容处理
interface Subject {
    public  function methodA();
    public  function methodB();
}


class OldSubject {
    public function methodA() {
        echo "我只实现了方法A\n";
    }
}

class NewSubject {
    public function method() {
        echo "我改版了哦\n";
    }
}



class Adapter implements Subject{
    private $subject;
    public function __construct ($subject) {
        $this->subject = $subject;
    }

    public function methodA() {
        echo "方法A用已有的\n";
        $this->subject->methodA();
    }

    public function methodB() {
        echo "方法B也必须实现，求人不如求己，自己实现喽\n";
    }
}
/*
#外部对象没有改变前
$subject = new Adapter(new OldSubject());
$subject->methodA();
$subject->methodB();
*/



class AdapterV2 implements Subject{
    private $subject;
    public function __construct ($subject) {
        $this->subject = $subject;
    }

    public function methodA() {
        echo "原方法A改版\n";
        $this->subject->method();
    }

    public function methodB() {
        echo "方法B也必须实现，求人不如求己，自己实现喽\n";
    }
}
/*
#改版后
$subject = new AdapterV2(new NewSubject());
$subject->methodA();
$subject->methodB();
*/

#应对不同版本的变化，可以添加不同的适配器，客户端使用工厂模式使用对应的适配器实例
//简单工厂模式
class SimpleFactory {
    public static function  create ($version = '') {
        if ($version == "V2") {
            $obj = new AdapterV2(new NewSubject());
        } else {
            $obj = new Adapter(new OldSubject());
        }
        return $obj;
    }

}
//最老版本
$subject = SimpleFactory::create();
$subject->methodA();
$subject->methodB();

//第二版
$subject = SimpleFactory::create('V2');
$subject->methodA();
$subject->methodB();