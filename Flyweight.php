<?php
#享元模式：针对大量细粒度对象，避免大量拥有相同内容的小类的开销(如耗费内存),使大家共享一个类
interface  Piece{  //Flyweight
    public function display($extrinsicState);
}

class ConcretePiece implements Piece {  //ConcreteFlyweight
    private $intrinsicState = null;
    public function __construct($intrinsicState) {
        $this->intrinsicState = $intrinsicState;
    }
    public function display($extrinsicState) {
        echo $extrinsicState." -> ".$this->intrinsicState."\n";
    }
}


class UnsharedConcretePiece implements Piece {  //UnsharedConcreteFlyweight
    private $intrinsicState = null;
    public function __construct($intrinsicState) {
        $this->intrinsicState = $intrinsicState;
    }

    public function display($extrinsicState) {
        echo $extrinsicState." -> ".$this->intrinsicState."\n";
    }
}

class PieceFactory {   //FlyweightFactory
    private $pieces;

    public function __construct() {
        $this->pieces = array();
    }

    public function getPiece($intrinsicState) {
        if (isset($this->pieces[$intrinsicState])) {
            return $this->pieces[$intrinsicState];
        } else {
            return $this->pieces[$intrinsicState] = new ConcretePiece($intrinsicState);
        }
    }

    public function count() {
        return count($this->pieces);
    }
}

$pieceFactory = new PieceFactory();
$colorArr = array('红', '黑');
$n = 0;
foreach ($colorArr as $color){
    $pieceArr = array('车' => 2, '马' => 2, '象' => 2, '士' => 2, '炮' => 2, '兵' => 5, '将' => 1);
    foreach ($pieceArr as $piece => $count) {
        for ($i = 1; $i <= $count; $i++) {
            $n++;
            echo "第 ".$n." 个棋子对象\t目前共实例化：".$pieceFactory->count()."次\t";
            //老蒋棋子，独享存储
            if ($piece == "将") {
                $unsharedPieceObj = new UnsharedConcretePiece('将');
                $unsharedPieceObj->display($color);
            //普通棋子，共享存储
            } else {
                $pieceObj = $pieceFactory->getPiece($piece);
                $pieceObj->display($color);
            }
        }

    }

}