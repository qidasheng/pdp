<?php
//Expression
interface Expression {
    public function interpret(Context $context);
}
//Terminal Expression
class Constant implements   Expression {
    private $num;

    public function __construct($num){
        $this->num = $num;
    }


    public function interpret(Context $context) {
        return $this->num;
    }
}

//Terminal Expression
class Variable implements   Expression {
    private $key;

    public function __construct($key){
        $this->key = $key;
    }


    public function interpret(Context $context) {
        return $context->getVal($this->key);
    }
}

abstract class SymbolExpression implements Expression {
    protected $left;
    protected $right;
    public function __construct($left, $right) {
        $this->left  = $left;
        $this->right = $right;
    }
}

//Non terminal Expression
class Add extends  SymbolExpression {
    public function interpret(Context $context) {
        return $this->left->interpret($context) + $this->right->interpret($context);
    }
}

class Sub extends  SymbolExpression {
    public function interpret(Context $context) {
        return $this->left->interpret($context) - $this->right->interpret($context);
    }
}

class Mul extends  SymbolExpression {
    public function interpret(Context $context) {
        return $this->left->interpret($context) * $this->right->interpret($context);
    }
}

class Div extends  SymbolExpression {
    public function interpret(Context $context) {
        return $this->left->interpret($context) / $this->right->interpret($context);
    }
}


//Context
class Context {
    private $valArr;
    public function setVal($key, $val) {
        $this->valArr[$key] = $val;

    }

    public function getVal($key) {
        return $this->valArr[$key];
    }
}

//((x + y) * z - 100) / x
$context = new Context();
$varX = new Variable('x');
$vary = new Variable('y');
$varZ = new Variable('z');
$cons = new Constant(100);

$context->setVal('x', 11);
$context->setVal('y', 22);
$context->setVal('z', 33);

//((11 + 22) * 33 - 100)/11 = 89.9090909
$expression = new Div(new Sub(new Mul(new Add($varX, $vary), $varZ), $cons), $varX);
echo $expression->interpret($context);