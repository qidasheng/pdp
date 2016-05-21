<?php
header("Content-type: text/html; charset=utf-8");
//define('BR', "<br/>");
define('BR', "\n");
//抽象单元类
abstract class AbstractUnit {
    abstract function addUnit($tagName, $attr, $tagType = '');
    abstract function removeUnit($tagName);
    abstract function display();
}


class Input extends AbstractUnit {
    private $inputs = array();
    private $inputName;
    public function __construct($inputName) {
        $this->inputName = $inputName;
    }
    public function addUnit($tagName, $attr, $tagType = 'input') {
        $this->inputs[$tagName] =  array($attr, $tagType);
    }
    public function removeUnit($tagName) {
        foreach ($this->inputs as $key => $val) {
            if ($key == $tagName) {
                unset($this->inputs[$key]);
            }
        }
    }
    public function display() {
        foreach ($this->inputs as $key => $val) {
            $html = '';
            $attr = '';
            foreach($val[0] as $attrName => $attrVal) {
                $attr .= ' '.$attrName.'="'.$attrVal.'"';
            }
            if ($val[1] == 'button') {
                $html = "<".$val[1]." " . $attr . " >".$key."</".$val[1].">" . BR;
            }else {
                $html = $key . ":<".$val[1]." " . $attr . " />" . BR;
            }
            echo $html;
        }
    }

}

class Select extends AbstractUnit {
    private $options = array();
    private $name;
    private $selectName;
    public function __construct($name, $selectName) {
        $this->name = $name;
        $this->selectName = $selectName;
    }
    public function addUnit($tagName, $attr, $other = '') {
        $this->options[$tagName] =  $attr;
    }
    public function removeUnit($tagName) {
        foreach ($this->options as $key => $val) {
            if ($key == $tagName) {
                unset($this->options[$key]);
            }
        }
    }
    public function display() {
        echo $this->name.':<select name="'.$this->selectName.'">'."".BR;
        foreach ($this->options as $key => $val) {
            $html = '';
            $attr = '';
            foreach($val as $attrName => $attrVal) {
                $attr .= ' '.$attrName.'="'.$attrVal.'"';
            }
            $html = "<option ".$attr." >".$key."<option/>".BR;
            echo $html;
        }
        echo '</select>'.BR;
    }
}

class Form  extends AbstractUnit {
    private $tags = array();
    private $formName;
    public function __construct($formName) {
        $this->formName = $formName;
    }

    public function addUnit($tagName, $tagObj, $other = '') {
        $this->tags[$tagName] =  $tagObj;
    }
    public function removeUnit($tagName) {
        foreach ($this->tags as $key => $val) {
            if ($key == $tagName) {
                unset($this->tags[$key]);
            }
        }
    }
    public function display() {
        echo '<form name="'.$this->formName.'">'."".BR;
        foreach ($this->tags as $key => $tag) {
            echo $key.":".BR;
            echo $tag->display();
        }
        echo '</form>';
    }

}

$input = new Input('txt');
$input->addUnit('昵称', array('type'=>'text', 'name'=> 'nickname'));
$input->addUnit('密码', array('type'=>'text', 'name'=> 'password'));
//$input->display();

$select = new Select('出身年月', 'date');
$select->addUnit(2016, array('value'=>'2016'));
$select->addUnit(2015, array('value'=>'2015'));
//$select->display();


$input2 = new Input('radio');
$input2->addUnit('男', array('type'=>'radio', 'name'=>'sex', 'value'=>'man', 'checked'=>'checked'));
$input2->addUnit('女', array('type'=>'radio', 'name'=>'sex', 'value'=>'women'));


$input3 = new Input('checkbox');
$input3->addUnit('打球', array('type'=>'checkbox', 'name'=>'interest', 'value'=> '1'));
$input3->addUnit('游泳', array('type'=>'checkbox', 'name'=>'interest', 'value'=> '2'));

$input4 = new Input('button');
$input4->addUnit('提交', array('type'=>'submit', 'value'=> '1'), 'button');
$input4->addUnit('重置', array('type'=>'reset',  'value'=> '2'), 'button');


$form = new Form('register');
$form->addUnit('文本', $input);
$form->addUnit('选择', $select);
$form->addUnit('单选', $input2);
$form->addUnit('复选', $input3);
$form->addUnit('按钮', $input4);
$form->display();





