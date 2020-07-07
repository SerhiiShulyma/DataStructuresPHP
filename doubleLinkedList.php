<?php

class Node 
{
    private $previous;
    private $next;
    private $data;

    public function __construct()
    {
        $this->previous = null;
        $this->next = null;
        $this->data = null;

    }
    /**
     * 
     */
    public function getPrevious()
    {
        return $this->previous;
    }
    public function setPrevious($previous)
    {
        $this->previous=$previous;
    }
    /***
     * 
     * 
     */
    public function getNext()
    {
        return $this->next;
    }
    public function setNext($next)
    {
        $this->next=$next;
    }
    /**
     * 
     * 
     */
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data=$data;
    }
}


class DoubleLinkedList
{
    private $head;
    private $tail;

    public function __construct()
    {
        $this->head= null;
        $this->tail= null;
    }

/**
 * 
 */
    public function addNodeAtTheBeginning($data): void
    {
        $newNode = new Node();
        $newNode->setData($data);  
        if($this->head){
            $current = $this->head;
            $newNode->setNext($this->head);
            $current->setPrevious($newNode);
            $this->head = $newNode;
        } else {
            $this->head = $newNode;
            $this->tail = $newNode;
        }
    }
/**
 * 
 */
    public function addNodeAtTheEnd($data): void
    {
        $newNode = new Node();
        $newNode->setData($data);  
        if($this->tail){
            $current = $this->tail; 
            $newNode->setPrevious($this->tail);
            $current->setNext($newNode);
            $this->tail = $newNode;
        } else {
            $this->head = $newNode;
            $this->tail = $newNode;
            
        }

    }
/**
 * 
 */
    public function addNodeAfterSpecificNode($data, $value): bool
    {
        if ($this->head){
            $current=$this->head;
            while ($current->getNext() !=null && $current->getData() != $value) {
                $current = $current->getNext();
            }
            if($current->getData() == $value){
                $newNode = new Node();
                $newNode->setData($data);

                $nextNode = $current->getNext();
                $current->setNext($newNode);
                $newNode->setPrevious($current);
                if($nextNode){
                    $newNode->setNext($nextNode);
                    $nextNode->setPrevious($newNode);
                } else {
                    $newNode->setNext(null);
                    $this->tail=$newNode;
                }
            }
            return true;
        }
        return false; 
    }
/**
 * 
 */
    public function deleteNodeAtTheBeginning(): bool
    {
        if($this->head){
            try{
                $current= $this->head;
                $next=$current->getNext();
                if($next){
                    $this->head=$current->getNext();
                    unset($current);
                } else {
                    unset($current);
                    $this->tail= null;
                    $this->head= null;
                    throw new Exception ("Sorry! List is empty");
                }
                return true;
            } catch(Exception $e) {
                unset($current);
                $this->tail= null;
                $this->head= null;
               echo "Sorry! List is empty";
            }
        }
        return false;
    }
/**
 * 
 */    
    public function deleteNodeAtTheEnd(): bool
    {
        if($this->tail){
            try{
                $current= $this->tail; 
                $previous=$current->getPrevious();
                var_dump($current); 
                if($previous){
                    $previous->setNext(null);
                    $this->tail=$previous;
                    unset($current);
                } else {
                    unset($current);
                    $this->tail= null;
                    $this->head= null;
                    throw new Exception ("Sorry! List is empty");
                }
                return true;
            } catch(Exception $e) {
                unset($current);
                $this->tail= null;
                $this->head= null;
               echo "Sorry! List is empty";
            }
        }
        return false;
    }
/**
 * 
 * 
 */
    public function deleteSpecificNode($value)
    {
        if($this->head){
            $current=$this->head;
            $previous=null;
            while ($current->getData() != $value && $current->getNext() != null) {
                $previous=$current;
                $current = $current->getNext();
            }
            $nextNode = $current->getNext();
            if($current->getData() == $value)
            {
                if($previous && $nextNode){
                    $previous->setNext($nextNode);
                    $nextNode->setPrevious($previous);
                    unset($current);
                } else if ($previous  && $nextNode == null){
                    $previous->setNext(null);
                    $this->tail = $previous;
                    unset($current);
                } else if ($previous == null && $nextNode ) {
                    $this->head = $nextNode;
                    $nextNode->setPrevious(null);
                    unset($current);
                } else {
                    throw new \Exception ("Empty list");
                }
            }
            return true;  
        }
        return false;
    }

    public function showListValues()
    {
        if($this->head){
            $current=$this->head;
            $data = [];
            while ($current != null) {
               array_push($data, $current->getData());
               $current = $current->getNext(); 
            }
            print_r($data);
           // print_r($this->tail);
        }
    }

}

$doubleLinkedList = new DoubleLinkedList();
$doubleLinkedList->addNodeAtTheBeginning(0);
$doubleLinkedList->addNodeAtTheBeginning(10);

 $doubleLinkedList->addNodeAtTheBeginning(10000);
 $doubleLinkedList->addNodeAtTheBeginning(1000);
// $doubleLinkedList->addNodeAtTheBeginning(15400);
// $doubleLinkedList->addNodeAtTheBeginning(0);
// $doubleLinkedList->addNodeAtTheBeginning(-2);
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
$doubleLinkedList->addNodeAfterSpecificNode(-10000, 1000);
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheEnd();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteSpecificNode(10000);
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
$doubleLinkedList->deleteSpecificNode(10);
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheEnd();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");

// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheBeginning();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
$doubleLinkedList->deleteNodeAtTheEnd();
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
$doubleLinkedList->deleteNodeAtTheEnd();
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
$doubleLinkedList->deleteNodeAtTheEnd();
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
$doubleLinkedList->deleteNodeAtTheEnd();
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");

$doubleLinkedList->deleteSpecificNode(10);
$doubleLinkedList->showListValues();
echo nl2br("\n\n\n");
// $doubleLinkedList->deleteNodeAtTheEnd();
// $doubleLinkedList->showListValues();
// echo nl2br("\n\n\n");
