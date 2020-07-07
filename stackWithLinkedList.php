<?php

class Node 
{
    private $data;
    private $previous;

    public function __construct()
    {
        $this->data=0; 
        $this->previous=null; 
    }
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data=$data;
    }
    public function getPrevious()
    {
        return $this->previous;
    }
    public function setPrevious($previous)
    {
        $this->previous=$previous;
    }
}

class Stack
{
    private $head;

    public function __construct()
    {
        $this->head=null;
    }

    public function push($data)
    {
        $newNode= new Node();
        $newNode->setData($data);
        if($this->head){
            $newNode->setPrevious($this->head);
            $this->head=$newNode;
        } else {
           $this->head= $newNode;
        }
    }

    public function pop()
    {
        if($this->head){
            $currentNode = $this->head;
            $this->head = $currentNode->getPrevious();
            $value= $currentNode->getData();
            unset($currentNode);    
        } else{
            throw new \Exception("Array is Empty");
        }

        return $value;
    }
    public function peek()
    {
        if($this->head){
            $currentNode=$this->head;
        } else {
            throw new \Exception("Array is Empty");
        }
        return $currentNode->getData();
    }

}

$stack=new Stack();
$stack->push(10);
$stack->push(100);
$stack->push(1210);
echo $stack->pop();
echo nl2br("\n");
echo $stack->peek();
var_dump($stack);