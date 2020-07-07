<?php

class Node
{
    private $next;
    private $data;

    public function __construct()
    {
        $this->next=null;
        $this->data=null;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
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
}

class Set 
{
    private $head;

    private $countOfElements;

    public function __construct()
    {
        $this->head=null;
        $this->countOfElements =0;
    }

    public function getCountOfElements(): int
    {
        try {  
            $count=$this->countOfElements;      
            if($this->head){
                $current=$this->head;
                while($current!=null){
                    $count++;
                    $current=$current->getNext();
                }

            } else {
                $count=0;
            }
            return $count;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function Add($value)
    {
        try {
            if($this->head){
                $current= $this->head;
                while($current->getNext() != null && $current->getData() != $value){
                    $current = $current->getNext();       
                }
                if($current->getData() == $value){
                    return;
 //                   throw new Exception ("This elements presents in Set");
                }
                $newNode = new Node();
                $newNode->setData($value);
                $current->setNext($newNode);

            } else {
                $newNode = new Node();
                $newNode->setData($value);
                $this->head = $newNode;
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function Remove($value)
    {
        try{
            if($this->head){
                $current= $this->head;
                $previous= null;
                while($current->getNext() != null && $current->getData() !=$value){
                    $previous= $current;
                    $current= $current->getNext();
                }
                if($current->getData() == $value){
                    if($previous){
                        $previous->setNext($current->getNext());
                        unset($current); 
                    } else {
                        $this->head = $current->getNext();
                        unset($current);     
                    }
                } else {
                    throw new Exception("There isn't this element in Set");
                }
            } else {
                throw new Exception("Set is empty!!");
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }   
    }

    public function getElements($type='return')
    {
        try{
            if($this->head){
                $elements = array();
                $current = $this->head;
                while($current !=null){
                    $elements[] = $current->getData();
                    $current= $current->getNext();
                }
                switch($type){
                    case 'return':
                        return $elements;
                    break;
                    case 'print':
                        print_r($elements);
                    break;
                }
            } else {
                return;
//                throw new Exception ("Set is Empty!!");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }    
    }

    public function Union(Set $set): Set
    {
        try {
            if($this->head != null || $setB != null){
                $unionSet = new Set();
                $current = $this->head;
                if($this->head != null){
                    while($current!=null){
                        $unionSet->Add($current->getData());
                        $current= $current->getNext();  
                    }
                }
                if($set->getElements()){
                    foreach($set->getElements() as $element){
                        $unionSet->Add($element);
                    }
                }
                return $unionSet;
            } else {
                throw new Exception("Set is empty");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }  
    }

    /**
     * 
     * 
     */
    public function Intersection(Set $set)
    {
        try {
            if($set->getElements() && $this->head){
                $current= $this->head;
                $intersection = new Set();
                while($current != null){
                    $isFind=false;
                    for ($i=0; $i < count($set->getElements()) && !$isFind; $i++){
                        if ($set->getElements()[$i] === $current->getData()){
                            $intersection->Add($set->getElements()[$i]);
                            $isFind = true;
                        }
                    }
/*****with foreach and break */
//                    foreach($set->getElements() as $element){
//                        if($current->getData() === $element){
//                            $intersection->Add($element);
//                        break; 
//                        }
//                    }
/****end */
                    $current = $current->getNext();
                }
                return $intersection;
            }else {
                throw new Exception("Intersection is empty set");
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function Difference(Set $set)
    {
        try {
            if($this->head != null){
                $difference = new Set();
                if($set->getElements()){
                    $current= $this->head;
                    while ($current != null) {
                        $isFind=false;
                        for($i=0; $i<count($set->getElements()) && !$isFind; $i++){
                            if($current->getData() === $set->getElements()[$i]){
                                $isFind=true;      
                            }
                        }
                        if(!$isFind){
                            $difference->Add($current->getData()); 
                        }
                        $current=$current->getNext();  
                    }

                } else {
                    $current=$this->head;
                    while ($current !=null) {
                        $difference->Add($current->getData());
                        $current=$current->getNext();
                    }
                }
                return $difference;
            } else {
                throw new Exception ("Difference is empty set");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function Subset(Set $set): bool
    {
        $subSetCount =$set->getCountOfElements();
        $currentCount= $this->getCountOfElements();
        if($currentCount < $subSetCount){
            return false;
        } else {
            if($this->head){
                if($subSetCount>0){
                    $howMuchElementsAreEqual=0;
                    foreach($set->getElements() as $element){
                        $elementIsPresent=false;
                        $current=$this->head;
                        while($current != null && !$elementIsPresent){
                            if($current->getData() === $element){
                                $elementIsPresent=true;
                            }
                            $current=$current->getNext();
                        }
                        if($elementIsPresent){
                            $howMuchElementsAreEqual++;
                        } else {
                            return false;
                        }
                    }
                    if($howMuchElementsAreEqual === $subSetCount){
                        return true;
                    }
                } else if($subSetCount==0){
                    return true;
                }
            } else {
                return false;
            }

        }
    }

    public function SymmetricDifference(Set $set): Set
    {
        
        $leftDifferent=$this->Difference($set);
        $rightDifferent=$set->Difference($this);
        $symmetricDifference=$rightDifferent->Union($leftDifferent);

        return $symmetricDifference;
    }


}



$setA = new Set();
$setA->Add(1);
$setA->Add(2);
$setA->Add(-3);
$setA->Add(4);


$setB = new Set();
$setB->Add(1);
$setB->Add(2);
$setB->Add(3);
$setB->Add(5);


$setC = new Set();
$setC->Add(1);
$setC->Add(2);

$setD = new Set();



$union= $setA->Union($setB);
$union->getElements('print');
echo nl2br("\n\n");
$intersection= $setA->Intersection($setB);
$intersection->getElements('print');
echo nl2br("\n\n");
$difference1= $setA->Difference($setB);
$difference1->getElements('print');
echo nl2br("\n\n");
$difference2= $setB->Difference($setA);
$difference2->getElements('print');
echo nl2br("\n\n");

$subset1= $setA->Subset($setC);
var_dump($subset1);
echo nl2br("\n\n");

$subset2= $setA->Subset($setD);
var_dump($subset2);
echo nl2br("\n\n");

$subset3= $setD->Subset($setC);
var_dump($subset3);
echo nl2br("\n\n");

$difference2= $setB->SymmetricDifference($setA);
$difference2->getElements('print');
echo nl2br("\n\n");














