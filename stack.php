<?php

class Stack
{
    private $tos;
    private $stack = [];

    public function __construct()
    {
        $this->tos=-1;
    }

    public function push($value): void 
    {
        $this->tos++;
        $this->stack[$this->tos]= $value;
    }

    public function pop(): int
    {
        if($this->tos < 0)
        {
            return -1;
        }
        $value = $this->stack[$this->tos];
        unset($this->stack[$this->tos]);
        $this->tos--;
        return $value;
    }

    public function peek(): int
    {
        if($this->tos < 0)
        {
            return -1;
        }
        $value = $this->stack[$this->tos];
        return $value;
    }

}

$stack = new Stack();
$stack->push(10);
$stack->push(100);
$stack->push(1210);
var_dump($stack);
echo $stack->pop();
echo "\n\n";
var_dump($stack);
echo $stack->peek();
var_dump($stack);
