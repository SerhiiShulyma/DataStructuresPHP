<?php

class Item
{
    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key=$key;
        $this->value=$value;
    }

    public function __toString()
    {
        return "{$this->key}";
    }
    public function getKey()
    {
        return $this->key;
    }
    public function getValue()
    {
        return $this->value;
    }
    
}

class Dictionary
{
    private $dictionaryLength;
    private $dictionary = array();
    private $keyArray = array();

    public function __construct($dictionaryLength)
    {
        $this->dictionaryLength=$dictionaryLength;
        for($i=0; $i<$this->dictionaryLength; $i++){
            $this->dictionary[$i]=null;
            $this->keyArray[$i]=0;
        }
        
    }

    public function Add(Item $item)
    {
        try{
            $key=$this->getHash($item);
            
            if($this->dictionary[$key]==null){
                $this->dictionary[$key]=$item;
                $this->keyArray[$key]++;
            } else {
                $isFind= false;
                for($i=$key; $i<$this->dictionaryLength && !$isFind; $i++){
                    if($this->dictionary[$i]==null){
                        $this->dictionary[$i]=$item;
                        $this->keyArray[$key]++;
                        $isFind= true;           
                    }
                }
                for($i=0; $i<$key && !$isFind; $i++){
                    if($this->dictionary[$i]==null){
                        $this->dictionary[$i]=$item;
                        $this->keyArray[$key]++;
                        $isFind= true;           
                    }
                }
                if(!$isFind){
                    throw new Exception("Dictionary is Full");
                }
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function Remove(Item $item)
    {
       try{
            $key=$this->getHash($item);
            if($this->dictionary[$key]!=null || $this->keyArray[$key] > 0){
                $isFind= false;
                if($this->dictionary[$key]!=null && $this->keyArray[$key] == 1){
                    if($this->dictionary[$key]->getValue()==$item->getValue()){
                        $this->dictionary[$key]=null;
                        $this->keyArray[$key]--;
                    } else {
                        $i=$key;
                             while($i<$this->dictionaryLength && !$isFind){
                                 if($this->dictionary[$i]!=null){
                                     if($this->dictionary[$i]->getValue()==$item->getValue()){
                                         $isFind= true;
                                     }                               
                                 }         
                                 $i++;
                             }
                        if(!$isFind){
                             $i=0;
                             while($i<$key && !$isFind){
                                 if($this->dictionary[$i]!=null){
                                     if($this->dictionary[$i]->getValue()==$item->getValue()){
                                         $isFind= true;
                                     }                                
                                 }      
                                 $i++;
                             }
                        }
                        $i--;
                        $this->dictionary[$i]=null;
                        $this->keyArray[$key]--;
                    }
                } else {
                   $i=$key;
                        while($i<$this->dictionaryLength && !$isFind){
                            if($this->dictionary[$i]!=null){
                                if($this->dictionary[$i]->getValue()==$item->getValue()){
                                    $isFind= true;
                                }                               
                            }         
                            $i++;
                        }
                   if(!$isFind){
                        $i=0;
                        while($i<$key && !$isFind){
                            if($this->dictionary[$i]!=null){
                                if($this->dictionary[$i]->getValue()==$item->getValue()){
                                    $isFind= true;
                                }                                
                            }      
                            $i++;
                        }
                   }
                   $i--;
                   if(!$isFind){
                        throw new Exception("There isn't such element");
                   } else {
                        $this->dictionary[$i]=null;
                        $this->keyArray[$key]--;
                   }
               }   
            } else {
                throw new Exception("There isn't such element");
            }

        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
    public function Search(Item $item)
    {
        try{
            $key=$this->getHash($item);
            if($this->dictionary[$key]!=null || $this->keyArray[$key] > 0){
                $isFind= false;
                if($this->dictionary[$key]!=null && $this->keyArray[$key] == 1){
                    if($this->dictionary[$key]->getValue()==$item->getValue()){
                        return $this->dictionary[$key]->getValue();
                    } else {
                        $i=$key;
                             while($i<$this->dictionaryLength && !$isFind){
                                 if($this->dictionary[$i]!=null){
                                     if($this->dictionary[$i]->getValue()==$item->getValue()){
                                         $isFind= true;
                                     }                               
                                 }         
                                 $i++;
                             }
                        if(!$isFind){
                             $i=0;
                             while($i<$key && !$isFind){
                                 if($this->dictionary[$i]!=null){
                                     if($this->dictionary[$i]->getValue()==$item->getValue()){
                                         $isFind= true;
                                     }                                
                                 }      
                                 $i++;
                             }
                        }
                        $i--;
                        return $this->dictionary[$i]->getValue();
                    } 


                } else {
                    $i=$key;
                    while($i<$this->dictionaryLength && !$isFind){
                        if($this->dictionary[$i]!=null){
                            if($this->dictionary[$i]->getValue()==$item->getValue()){
                                $isFind= true;
                            }    
                        }         
                        $i++;
                    }
                     if(!$isFind){
                         $i=0;
                         while($i<$key && !$isFind){
                             if($this->dictionary[$i]!=null){
                                 if($this->dictionary[$i]->getValue()==$item->getValue()){
                                     $isFind= true;
                                 }                                
                             }      
                             $i++;
                         }
                    }
                    $i--;
                    if(!$isFind){
                         throw new Exception("There isn't such element");
                    } else {
                         return $this->dictionary[$i]->getValue();
                     }
                }   
            } else {
                throw new Exception("There isn't such element");
            }

        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    private function getHash(Item $item)
    {
        return (int)strlen($item)%$this->dictionaryLength;
    }   
}

$dictionary = new Dictionary(10);

$dictionary->Add(new Item(10, "John Doe"));
$dictionary->Add(new Item(25, "Richard Richardson"));
$dictionary->Add(new Item(100, "Joe Smith"));
$dictionary->Add(new Item(30, "Alice Wonderland"));
var_dump($dictionary);

$dictionary->Remove(new Item(10, "John Doe"));
$dictionary->Remove(new Item(30, "Alice Wonderland"));
//$dictionary->Remove(new Item(100, "Joe Smith"));

var_dump($dictionary);
//echo $dictionary->Search(new Item(25, "Richard Richardson"));
echo $dictionary->Search(new Item(100, "Joe Smith"));
