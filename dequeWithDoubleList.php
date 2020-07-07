<?php

class Node 
{
    private $previous;
    private $next;
    private $data;

    public function __construct()
    {
        $this->previous=null;
        $this->next=null;
        $this->data=null;
    }

    public function getPrevious()
    {
        return $this->previous;
    }
    public function setPrevious($previous)
    {
        $this->previous=$previous;
    }
    public function getNext()
    {
        return $this->next;
    }
    public function setNext($next)
    {
        $this->next=$next;
    }
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data=$data;
    }
}

class Deque
{
    private $head;
    private $tail;

    public function __construct()
    {
        $this->head=null;
        $this->tail=null;
    }

    public function pushForward($value)
    {
        $newNode =new Node();
        $newNode->setData($value);
        if($this->head){
            $current= $this->head;
            $newNode->setNext($current);
            $current->setPrevious($newNode);
            $this->head=$newNode;
        } else {
            $this->head=$newNode;
            $this->tail=$newNode;
        }
    }
    public function pushBack($value)
    {
        $newNode =new Node();
        $newNode->setData($value);

        if($this->tail){
            $current= $this->tail;
            $newNode->setPrevious($current);
            $current->setNext($newNode);
            $this->tail=$newNode;
        } else {
            $this->head=$newNode;
            $this->tail=$newNode;
        }
    }
        
    public function popForward()
    {
        try {
            if($this->head){
                $current= $this->head;
                $nextNode=$current->getNext();
                $value = $current->getData();
                unset($current);
                $this->head = $nextNode;
 //               $nextNode->setPrevious(null);
                
                return $value;
            } else {
                throw new Exception("List is empty");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function popBack()
    {
        try {
            if($this->head){
                $current= $this->tail;
                $previousNode=$current->getPrevious();
                $value = $current->getData();
                unset($current);
                $this->tail = $previousNode;
                $previousNode->setNext(null);
                return $value;
            } else {
                throw new Exception("List is empty");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function peekForward()
    {
        try {
            if($this->head){
                $current= $this->head;
                $value = $current->getData();
                return $value;
            } else {
                throw new Exception("List is empty");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    public function peekBack()
    {
        try {
            if($this->head){
                $current= $this->tail;          
                $value = $current->getData();
                return $value;
            } else {
                throw new Exception("List is empty");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

$dequeList = new Deque();
$dequeList->pushForward(10);
$dequeList->pushForward(-1000);
$dequeList->pushBack(100);
$dequeList->pushBack(10);

echo $dequeList->popBack();
echo nl2br("\n\n");

echo $dequeList->popForward();
echo nl2br("\n\n");

echo $dequeList->popForward();
echo nl2br("\n\n");

echo $dequeList->popForward();
echo nl2br("\n\n");

echo $dequeList->popForward();
echo nl2br("\n\n");

echo $dequeList->popBack();
echo nl2br("\n\n");

echo $dequeList->popBack();
echo nl2br("\n\n");

echo $dequeList->popBack();
echo nl2br("\n\n");
