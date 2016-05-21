<?php
//单例类
class Single
{
    private static $instance = NULL;
    private $props = array();

    public static function getInstance()
    {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;

    }

    public function getProp($name)
    {
        return isset($this->props[$name]) ? $this->props[$name] : null;
    }

    public function setProp($name, $val)
    {
        $this->props[$name] = $val;
    }

    private function __clone() {

    }
}



$singleObj = Single::getInstance();
$singleObj->setProp('name', 'Qidasheng');

unset($singleObj);
$singleObj2 = Single::getInstance();
echo $singleObj2->getProp('name');
