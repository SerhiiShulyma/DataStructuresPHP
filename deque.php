<?php

class DequeArr
{
    private $queue= [];
    private $tos;

    public function __construct()
    {
        $this->tos=-1;
    }

    public function pushBack($value)
    {
        $this->tos++;
        $this->queue[$this->tos]=$value;
    }

    public function popBack()
    {
        try{
            if($this->tos < 0){
                throw new Exception("List is Empty");  
            }
            $value = $this->queue[$this->tos];
            unset($this->queue[$this->tos]);
            $this->tos--;
            return $value;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
    public function pushForward($value)
    {
        try{
            if($this->tos ==-1){
                $this->tos++;
                $this->queue[]=$value;
            } else{
                $counter=$this->tos;
                $this->queue[]=0;
                for($i=$counter; $i>=0; $i--){
                    $this->queue[$i+1]=$this->queue[$i];
                }
                $this->tos++;
                $this->queue[0]=$value;
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function popForward()
    {
        try{
            if($this->tos < 0){
                throw new Exception("List is Empty");  
            }
            $value= $this->queue[0];
            $counter=$this->tos;
            for($i=0; $i<$counter; $i++){
                $this->queue[$i]=$this->queue[$i+1];
            }
            unset($this->queue[$i]);
            $this->tos--;
            return $value;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function peekBack()
    {
        $value = $this->queue[$this->tos];
        return $value;
    }

    public function peekForward()
    {
        $value= $this->queue[0];
        return $value;
    }
}

$dequeArr = new DequeArr();

$dequeArr->pushForward(78);
$dequeArr->pushBack(-25);
$dequeArr->pushBack(205);
$dequeArr->pushForward(10);
 var_dump($dequeArr);
echo $dequeArr->popBack();
echo nl2br("\n");
echo $dequeArr->popForward();
echo nl2br("\n");
echo $dequeArr->popForward();
echo nl2br("\n");
echo $dequeArr->popBack();
echo nl2br("\n");
echo $dequeArr->popBack();
echo nl2br("\n");