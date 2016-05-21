<?php
#原型模式：当对象的构造函数非常复杂，在生成新对象的时候非常耗时间、耗资源时,通过复制（克隆、拷贝）一个指定类型的对象来创建更多同类型的对象（工厂模式每次都需要new）
interface Prototype {
    public function copy();
}

class ConcretePrototype implements Prototype {
    private $name;
    public function __construct($name) {
        $this->name = $name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function copy() {
        return clone $this;
    }
}

$ConcretePrototype = new ConcretePrototype('原型');
//$ConcretePrototype->setName('齐大圣');
echo $ConcretePrototype->getName()."\n";

$ConcretePrototype2 = $ConcretePrototype->copy();
echo $ConcretePrototype2->getName()."\n";