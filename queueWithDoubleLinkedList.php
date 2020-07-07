<?php

class Node
{
    private $next;
    private $previous;
    private $data;


    public function __construct()
    {
        $this->next=null;
        $this->previous=null;
        $this->data=null;
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

class QueueWithList
{
        private $tail;
        private $head;

        public function __construct()
        {
            $this->head=null;
            $this->tail=null;
        }
        

        public function push($value)
        {
            $newNode =new Node();
            $newNode->setData($value);

            if($this->tail){
                $current=$this->tail;
                $current->setNext($newNode);
                $newNode->setPrevious($current);
                $this->tail= $newNode;
            } else {
                $this->head=$newNode;
                $this->tail=$newNode;
            }
        }

        public function pop()
        {
            try{
                if($this->head){
                    $current= $this->head;
                    $value=$current->getData();
                    $this->head= $current->getNext();
                    unset($current);
                    return $value;
                } else {
                    throw new Exception("Queue is emptyyyyy");
                }
            } catch (Exception $e){
                echo "Queue is empty" . $e->getMessage(); 
            }
       
        }

        public function peek()
        {
            try{
                if($this->head){
                    $current= $this->head;
                    $value=$current->getData();
                    return $value;
                } else {
                    throw new Exception("Queue is emptyyyy");
                }
            } catch (Exception $e){
                echo "Queue is empty" . $e->getMessage(); 
            }
            
        }  
}

$queuelist = new QueueWithList;
$queuelist->push(10);
$queuelist->push(0);
$queuelist->push(-100);
echo $queuelist->pop();
echo nl2br("\n\n");
echo $queuelist->pop();
echo nl2br("\n\n");
echo $queuelist->peek();
echo nl2br("\n\n");
echo $queuelist->pop();
echo nl2br("\n\n");
echo $queuelist->pop();

