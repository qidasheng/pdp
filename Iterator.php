<?php
class myIterator implements Iterator {
    private $position = 0;
    private $array = array();

    public function __construct($array = array()) {
        $this->array = $array;
        $this->position = 0;
    }

    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->array[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->array[$this->position]);
    }
}


$array = array(
    "qi",
    "sheng",
    "fu",
    "!",
);

$it = new myIterator($array);

foreach($it as $key => $value) {
    echo $key, $value;
    echo "\n";
}
