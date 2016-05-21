<?php
#封装创建过程，分离创建过程和表示过程，使用相同的构建过程创建不同的产品或表示
class Animal {
    public $header;
    public $body;
    public $footer;
    public function setHeader($header) {
        $this->header = $header;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setFooter($footer) {
        $this->footer = $footer;
    }

    public function display() {
        echo $this->header."\n";
        echo $this->body."\n";
        echo $this->footer."\n";
    }

}

abstract class Builder {
    abstract function builderHeader();
    abstract function builderBody();
    abstract function builderFooter();
    abstract function getAnimal();

}

class BuilderBird extends Builder {
    private $animal;
    public function __construct() {
        $this->animal = new Animal();
    }

    public function BuilderHeader() {
        $this->animal->setHeader('鸟头');
    }

    public function BuilderBody() {
        $this->animal->setBody('鸟身');
    }

    public function BuilderFooter() {
        $this->animal->setFooter('鸟爪');
    }

    public function getAnimal() {
        return $this->animal;
    }
}


class BuilderPerson extends Builder {
    private $animal;
    public function __construct() {
        $this->animal = new Animal();
    }

    public function BuilderHeader() {
        $this->animal->setHeader('人头');
    }

    public function BuilderBody() {
        $this->animal->setBody('人身');
    }

    public function BuilderFooter() {
        $this->animal->setFooter('人脚');
    }

    public function getAnimal() {
        return $this->animal;
    }
}

class Director {
    public function createAnimal(Builder $builder) {
        $builder->builderHeader();
        $builder->builderBody();
        $builder->builderFooter();
        return $builder->getAnimal();
    }
}


$director  = new Director();
$animalObj = $director->createAnimal(new BuilderBird());
$animalObj->display();

$animalObj = $director->createAnimal(new BuilderPerson());
$animalObj->display();