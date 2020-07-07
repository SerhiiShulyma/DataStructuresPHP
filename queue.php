<?php

class Queue
{
    private $queue =[];
    private $counter;

    public function __construct()
    {
        $this->counter = 0;
    }

    public function push($value)
    {
        $this->queue[]=$value;
        $this->counter++;
    }
    public function pop()
    {
        try {
            if($this->counter <= 0){
                throw new Exception("Queue is empty");
            }
            $value = $this->queue[0];
            $q=$this->counter;
            for ($i=0; $i < $q-1; $i++){
                $this->queue[$i]=$this->queue[$i+1];
            }
            unset($this->queue[$i]);
            $this->counter--;
            return $value;
        } catch(Exception $e) {
            echo "Queue is empty" . $e; 
        }
    }
    /*****  Дописати !!! */
    public function peek()
    {
        try {
            if($this->counter <= 0) {
                throw new Throwable ("Queue is empty");   
            }
            $value = $this->queue[0];
            
        } catch (\Throwable $e) {
           echo "Queue is empty" . $e;
        }
        return $value;
    }
}

$queue=new Queue();

$queue->push(10);
$queue->push(100);
$queue->push(1110);
$queue->push(-2);
echo $queue->pop();
echo nl2br("\n\n");

echo $queue->pop();
echo nl2br("\n\n");

echo $queue->pop();
echo nl2br("\n\n");
echo $queue->peek();
echo $queue->pop();


