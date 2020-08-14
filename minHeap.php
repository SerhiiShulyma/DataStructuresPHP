<?php

class BinaryHeap
{
    private $heap;
    public function __construct()
    {
        $this->heap=array();
    }
//Get Min value of the Heap
    public function getMin()
    {
        try {
            if($this->howManyElementsInHeap() > 0){
                return $this->heap[0];
            } else{
                throw new Exception("GetMin --- Heap is empty!!!");   
            } 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
// Add value to Heap
    public function addElement($element)
    {
        try{
            if(!is_int($element)){
                throw new Exception("Wrong value!!");
            }
            $this->heap[]=$element;
            $quantity = $this->howManyElementsInHeap();
            $currentIndex =$quantity-1;
            $parrentIndex = intdiv($currentIndex-1, 2);
            while($this->heap[$currentIndex] < $this->heap[$parrentIndex] && $parrentIndex >= 0){
                $this->swap($currentIndex, $parrentIndex);
                $currentIndex=$parrentIndex;
                $parrentIndex = intdiv($currentIndex-1, 2);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
// Change elements
    private function swap($currentIndex, $parrentIndex)
    {
        $temp = $this->heap[$currentIndex];
        $this->heap[$currentIndex] = $this->heap[$parrentIndex];
        $this->heap[$parrentIndex] = $temp;
    }
// Delete max element
    public function deleteMinElement()
    {
        try {
            if($this->howManyElementsInHeap() > 0){
                $element = $this->heap[0];
                $quantity = $this->howManyElementsInHeap();
                $currentIndex =$quantity-1;
                $this->heap[0]=$this->heap[$currentIndex];
                unset($this->heap[$currentIndex]);
                array_values($this->heap);
                $this->heapBalancing(0);
                return $element;
            } else {
                throw new Exception("Cannot delete !! Heap is empty!!!");   
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }  
// Balancing of the Heap
    private function heapBalancing(int $currentIndex)
    {
        try {
            if($currentIndex < 0){
                throw new Exception("Wrong index");               
            } else {
                $quantity = $this->howManyElementsInHeap();
                $isBalanced= false;
                while($currentIndex < $quantity && !$isBalanced){
                    $leftChildIndex = 2*$currentIndex+1;
                    $rightChildIndex = 2*$currentIndex+2;
                    $maxElementIndex = $currentIndex;
                    if($leftChildIndex < $quantity && $this->heap[$maxElementIndex]>$this->heap[$leftChildIndex]){
                        $maxElementIndex=$leftChildIndex;
                    }
                    if($rightChildIndex < $quantity && $this->heap[$maxElementIndex]>$this->heap[$rightChildIndex]){
                        $maxElementIndex=$rightChildIndex;
                    }
                    if($currentIndex === $maxElementIndex){
                        $isBalanced= true;
                    }
                    $this->swap($currentIndex, $maxElementIndex);
                    $currentIndex = $maxElementIndex;
                }
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
// Return quantity of elements in Heap
    public function howManyElementsInHeap()
    {
        return count($this->heap);
    }
//Binary Heap sort
    public function SortedValueFromHeap()
    {    
        $sortedValue = array();           
        while($this->howManyElementsInHeap() > 0){
            $sortedValue[]= $this->deleteMinElement();
        }
        return $sortedValue;
    }
}

$heap = new BinaryHeap();

$heap->addElement(20);
$heap->addElement(11);
$heap->addElement(18);
$heap->addElement(7);
$heap->addElement(4);
$heap->addElement(13);
$heap->addElement(19);
echo "Min Heap : ";
echo nl2br("\n");
print_r($heap);
echo nl2br("\n\n");
// Sorted element from heap
echo "Sorted Values from Heap : ";
echo nl2br("\n");
print_r($heap->SortedValueFromHeap());
echo nl2br("\n\n");
echo $heap->deleteMinElement();
echo nl2br("\n\n");

// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");
// echo $heap->deleteMinElement();
// echo nl2br("\n\n");

print_r($heap);

