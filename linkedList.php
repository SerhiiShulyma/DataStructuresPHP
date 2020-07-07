<?php

class Node
{
    private $data;
    private $next;
    
    public function __construct()
    {
        $this->data=0;
        $this->next=null;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data=$data;
    } 

    public function getNext()
    {
        return $this->next;
    }

    public function setNext($next)
    {
        $this->next=$next;
    } 
}


class LinkedList
{
   private $head;
   
   public function __construct()
   {
       $this->head=null;
   }
/**
 * 
 * 
 */
   public function addNodeAtTheEnd($data)
   {
       $newNode= new Node();
       $newNode->setData($data);

       if($this->head){
           $currentNode=$this->head;
           while($currentNode->getNext()!=null)
           {
                $currentNode = $currentNode->getNext();
           }
           $currentNode->setNext($newNode);
       } else {
            $this->head = $newNode;
       }
   }
/**
 * 
 */
   public function addNodeAtTheBeggining($data)
   {
        $newNode = new Node();
        $newNode->setData($data);
        if($this->head){
            $newNode->setNext($this->head);
            $this->head=$newNode;
        } else {
            $this->head= $newNode;
        }

   }
/***
 * 
 */
   public function addNodeBeforeSpecialNode($data, $value): bool
   {
       
        if($this->head){
            $previousNode = null;
            $currentNode  = $this->head;
            $newNode = new Node();
            $newNode->setData($data);

            while($currentNode->getData()!=$value && $currentNode->getNext()!=null){
                $previousNode = $currentNode;
                $currentNode = $currentNode->getNext();
            }

            if($currentNode->getData() == $value){
                if($previousNode){
                    $previousNode->setNext($newNode);
                    $newNode->setNext($currentNode);
                } else {
                    $newNode->setNext($currentNode);
                    $this->head=$newNode;
                }
            }
            return true;
            
        }
        return false;
   }
/**
 * 
 * 
 */
    public function addNodeAfterSpecialNode($data, $value): bool {
        if($this->head){
            
            $currentNode = $this->head;
            while($currentNode->getNext() != null && $currentNode->getData() != $value){
                $currentNode= $currentNode->getNext();
            }
            if($currentNode->getData() == $value)
            {
                $newNode = new Node();
                $newNode->setData($data);

                $newNode->setNext($currentNode->getNext());
                $currentNode->setNext($newNode);
            }
            return true;
        }
        return false;
    }
/**
 * 
 */
   public function deleteNodeAtTheEnd(): bool 
   {
        if($this->head){
            $previousNode = null;
            $currentNode=$this->head;
            while ($currentNode->getNext() != null){
                $previousNode = $currentNode;
                $currentNode = $currentNode->getNext();
            }
            if($previousNode){
                unset($currentNode);
                $previousNode->setNext(null);               
            } else {
                $this->head = null;
            }
            return true;
        }
        return false;
   }

/**
 * 
 */
   public function deleteNodeAtTheBeggining(): bool
   {
        if($this->head){
            $currentNode=$this->head;
            $this->head=$currentNode->getNext();
            unset($currentNode);
            return true;
        }
        return false;
   }
/**
 * 
 */
public function deleteNodeAtSpecialPlace($value): bool
{   
    if($this->head){
        $currentNode = $this->head;
        $previousNode = null;
        while($currentNode->getData() != $value && $currentNode->getNext() !=null){
            $previousNode = $currentNode;
            $currentNode = $currentNode->getNext();
        }
        if($currentNode->getData() == $value){
            if($previousNode){
                $previousNode->setNext($currentNode->getNext());
                unset($currentNode);
            } else {
                $this->head = $currentNode->getNext();
                unset($currentNode);
            }
        }
        return true;
    }
    return false;
}
/**
 * 
 */
  public function printList(): void
  { 
      if($this->head){
          $currentNode = $this->head;
          $allDataInList = array();
          while ($currentNode != null){
            array_push($allDataInList, $currentNode->getData());
            $currentNode = $currentNode->getNext();
          }
      }
      print_r($allDataInList);
  }
}

$singlyLinkedList= new LinkedList();
$singlyLinkedList->addNodeAtTheEnd(1);
$singlyLinkedList->addNodeAtTheEnd(2);
$singlyLinkedList->addNodeAtTheEnd(3);
$singlyLinkedList->addNodeAtTheEnd(1000);
if($singlyLinkedList->deleteNodeAtSpecialPlace(3)){
    echo "Done" . "\n\n";
};

$singlyLinkedList->deleteNodeAtTheBeggining();
$singlyLinkedList->deleteNodeAtTheEnd();
$singlyLinkedList->deleteNodeAtTheEnd();

$singlyLinkedList->printList();


