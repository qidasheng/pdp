<?php
//-----------------------------简单工厂模式----------------------------------------
//抽象产品类
abstract class AbstractProduct {
    private  $productName ;
    abstract function operation1 ();
}


//具体产品类A
class ProductA {
    public function operation1() {
        echo "A operation1 echo Hello world!\r\n";
    }
}

//具体产品类B
class ProductB {
    public function operation1() {
        echo "B operation1 echo Hello world!\r\n";
    }
}



//简单工厂模式(无法在不修改代码的情况下增加新的产品)
class SimpleFactory {
    public static function  create ($productType) {

        if ($productType == "A") {
            $productObj = new ProductA();
        } elseif ($productType == "B") {
            $productObj = new ProductB();
        }
        return $productObj;
    }

}
echo "简单工厂模式示例\r\n";
$product = SimpleFactory::create('A');
$product->operation1();

$product = SimpleFactory::create('B');
$product->operation1();


//-----------------------------工厂方法模式----------------------------------------





//工厂方法模式（支持添加新的产品）
abstract class FactoryMethod {
    abstract function  createProduct ();

}

class FactoryA extends FactoryMethod {
    public  function  createProduct () {
        return new ProductA();
    }
}

class FactoryB extends FactoryMethod {
    public  function  createProduct () {
        return new ProductB();
    }
}

echo "工厂方法模式示例\r\n";

$factoryObj = new FactoryA();
$factoryObj->createProduct()->operation1();

$factoryObj = new FactoryB();
$factoryObj->createProduct()->operation1();


//如果需要添加新的产品，比如ProductC，只需要添加对应的产品类和工厂类即可，无需修改现有代码

//具体产品类C
class ProductC {
    public function operation1() {
        echo "C operation1 echo Hello world!\r\n";
    }
}


class FactoryC extends FactoryMethod {
    public  function  createProduct () {
        return new ProductC();
    }
}

echo "工厂方法模式添加产品示例\r\n";
$factoryObj = new FactoryC();
$factoryObj->createProduct()->operation1();


//-----------------------------抽象工厂模式----------------------------------------
//抽象产品类A
abstract class AbstractProductA {
    private  $productName ;
    abstract function operation1 ();
}

//抽象产品类B
abstract class AbstractProductB {
    private  $productName ;
    abstract function operation1 ();
}


//BIG簇 产品类A
class ProductBIGA extends AbstractProductA{
    public function operation1() {
        echo "BIG A operation1 echo Hello world!\r\n";
    }
}


//BIG簇 产品类B
class ProductBIGB extends AbstractProductB{
    public function operation1() {
        echo "BIG B operation1 echo Hello world!\r\n";
    }
}

//SMALL簇 产品类A
class ProductSmallA extends AbstractProductA{
    public function operation1() {
        echo "SMALL A operation1 echo Hello world!\r\n";
    }
}

//SMALL簇 产品类B
class ProductSmallB extends AbstractProductB{
    public function operation1() {
        echo "SMALL B operation1 echo Hello world!\r\n";
    }
}


//抽象工厂模式（支持添加新的产品簇，不支持添加产品）
abstract class AbstractFactory {
    abstract  function  createProductA ();
    abstract  function  createProductB ();
}

class AbstractFactoryBig extends AbstractFactory {
    public  function  createProductA () {
        return new ProductBigA();
    }

    public  function  createProductB () {
        return new ProductBigB();
    }
}

class AbstractFactorySmall extends AbstractFactory {
    public  function  createProductA () {
        return new ProductSmallA();
    }

    public  function  createProductB () {
        return new ProductSmallB();
    }
}

echo "抽象工厂模式示例\r\n";
$factoryBigObj = new AbstractFactoryBig();
$factoryBigObj->createProductA()->operation1();
$factoryBigObj->createProductB()->operation1();


$factoryBigObj = new AbstractFactorySmall();
$factoryBigObj->createProductA()->operation1();
$factoryBigObj->createProductB()->operation1();




//MINI簇 产品类A
class ProductMiniA extends AbstractProductA{
    public function operation1() {
        echo "MINI A operation1 echo Hello world!\r\n";
    }
}

//MINI簇 产品类B
class ProductMiniB extends AbstractProductB{
    public function operation1() {
        echo "MINI B operation1 echo Hello world!\r\n";
    }
}

class AbstractFactoryMini extends AbstractFactory {
    public  function  createProductA () {
        return new ProductMiniA();
    }

    public  function  createProductB () {
        return new ProductMiniB();
    }
}
echo "抽象工厂模式添加产品簇示例\r\n";
$factoryBigObj = new AbstractFactoryMini();
$factoryBigObj->createProductA()->operation1();
$factoryBigObj->createProductB()->operation1();

//-----------------------------原型模式----------------------------------------

class Factory {
    private $productA;
    private $productB;
    public function __construct($productA, $productB) {
        $this->productA = $productA;
        $this->productB = $productB;
    }

    public  function  getProductA () {
        return clone $this->productA;
    }

    public  function  getProductB () {
        return clone $this->productB;
    }

}


echo "原型模式示例\r\n";
$factory = new Factory(new ProductBIGA(), new ProductBIGA());
$factory->getProductA()->operation1();
$factory->getProductB()->operation1();
$factory = new Factory(new ProductBIGB(), new ProductBIGB());
$factory->getProductA()->operation1();
$factory->getProductB()->operation1();
$factory = new Factory(new ProductBIGA(), new ProductBIGB());
$factory->getProductA()->operation1();
$factory->getProductB()->operation1();
$factory = new Factory(new ProductBIGB(), new ProductBIGA());
$factory->getProductA()->operation1();
$factory->getProductB()->operation1();
