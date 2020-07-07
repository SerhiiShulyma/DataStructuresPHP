<?php

class Node 
{
    private $data;
    private $next;

    public function __construct()
    {
        $this->data=null;
        $this->next=null;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of next
     */ 
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Set the value of next
     *
     * @return  self
     */ 
    public function setNext($next)
    {
        $this->next = $next;

        return $this;
    }
}

class LinkedListForHashTable
{
    private $head;

    public function __construct()
    {
        $this->head=null;
    }

    public function Add($value)
    {
        $newNode = new Node();
        $newNode->setData($value);
        if($this->head){
            $newNode->setNext($this->head);
            $this->head=$newNode;
        } else {
            $this->head=$newNode;
        }
    }

    public function Equals($value): bool
    {
        if($this->head){
            $current=$this->head;
            while($current->getNext()!=null && $current->getData() != $value){
                $current=$current->getNext();
            }
            if($current->getData() == $value){
                return true;
            } 
        }
        return false;        
    } 
}

class Item
{
    private $key;
    private $nodes;

    public function __construct(int $key)
    {
        $this->key=$key;
        $this->nodes=new LinkedListForHashTable();
    }
    

    /**
     * Get the value of nodes
     */ 
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * Set the value of nodes
     *
     * @return  self
     */ 
    public function setNodes($nodes)
    {
        $this->nodes->Add($nodes);

        return $this;
    }
}

class Person 
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name= $name;
        $this->age= $age;
    }

    public function __toString()
    {
        return "{$this->name} + {$this->age}";
    }
}

class HashTable
{
    private $hashTableLength;
    private $items = array();

    public function __construct($hashTableLength)
    {   
        $this->hashTableLength=$hashTableLength;
        for($i=0; $i<$hashTableLength; $i++){
            $this->items[$i]= new Item($i);
        }
    }

    public function Add(Person $person)
    {
        $key = $this->getHash($person);
        $this->items[$key]->setNodes($person);
    }
    public function Find(Person $person): bool
    {
        $key = $this->getHash($person);
        return $this->items[$key]->getNodes()->Equals($person);
    }

    private function getHash(Person $person)
    {
        return (int)strlen($person)%$this->hashTableLength;
    }
}

$hashTable = new HashTable(10);
$hashTable->Add(new Person("John Doe", 10));
$hashTable->Add(new Person("Richard Richardson", 25));
$hashTable->Add(new Person("Joe Smith", 100));
$hashTable->Add(new Person("Alice Wonderland", 30));

print_r($hashTable);

$element_1=$hashTable->Find(new Person("Alice Wonderland", 30));
$element_2=$hashTable->Find(new Person("Ken Woo", 54));

var_dump($element_1);
var_dump($element_2);