<?php

class TrieNode
{
    private $data;
    private $isEnd;
    public $children= array();

    public function __construct()
    {
        $this->isEnd = false;
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
     * Get the value of isEnd
     */ 
    public function getIsEnd()
    {
        return $this->isEnd;
    }

    /**
     * Set the value of isEnd
     *
     * @return  self
     */ 
    public function setIsEnd($isEnd)
    {
        $this->isEnd = $isEnd;

        return $this;
    } 
}

class Person
{
    private $name;
    private $lastName;

    public function __construct($name, $lastName)
    {
        $this->name=$name;
        $this->lastName=$lastName;
    }
}

class Trie
{
    private $root;
    private $character;

    public function __construct()
    {
        $this->root = new TrieNode();
        
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function insert(string $key, Person $data)
    {
        try{
            $this->character=$this->root;
            $stringLength= strlen($key);
            for($i=0; $i<$stringLength; $i++){
                if (ord(substr($key, $i, 1))<65 || ord(substr($key, $i, 1))>122){
                    throw new Exception("Wrong character!! WE use only latin symbol as key");
                }
                $char = substr($key, $i, 1);
                if(!array_key_exists($char, $this->character->children)){
                    $this->character->children[$char] = new TrieNode();                    
                }
                $this->character=$this->character->children[$char];
            }
            $this->character->setIsEnd(true);
            $this->character->setData($data);
            $this->character = null;
        } catch(Exception $e){
            echo $e->getMessage();
        }
    } 

    public function retrieve(string $key)
    {
        try{
            $this->character=$this->root;
            $stringLength= strlen($key);
            for($i=0; $i<$stringLength; $i++){
                if (ord(substr($key, $i, 1))<65 && ord(substr($key, $i, 1))>122){
                    throw new Exception("Wrong character!! WE use only latin symbol as key");
                }
                $char = substr($key, $i, 1);
                if(!array_key_exists($char, $this->character->children)){
                    throw new Exception("There is no such key");
                    return false;
                }
                $this->character=$this->character->children[$char];
            }
            if($this->character != null && $this->character->getIsEnd()){
                return true;
            } else {
                throw new Exception("It is not a key-word");
                
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    } 

    private function notHasChildren(TrieNode $current)
    {
        foreach($current->children as $k=>$v){
            if(array_keys($current->children) && $v ){
                return false;
            }
        }
        return true;
    }

    public function removeKey(TrieNode $current, string $key, $depth = 0)
    {  
        try{ 
            if($depth === 0 && !$this->retrieve($key)){
                echo nl2br("\n\n\n\n");
            } else{   
                $stringLength = strlen($key);
                $char = substr($key, $depth, 1);
                if($depth === $stringLength){
                    if($current->getIsEnd()){
                        $current->setIsEnd(false);
                        $current->setData(null);
                    } 
                    if($this->notHasChildren($current)){
                        unset($current);
                        $current =null;
                    }
                    return $current;
                }
                $current->children[$char] = $this->removeKey($current->children[$char], $key, $depth+1);
                if($this->notHasChildren($current) && $current->getIsEnd()==false){
                    unset($current);
                    $current =null;
                } else{
                    $char = substr($key, $depth, 1);
                    unset($current->children[$char]);
                }
                return $current;
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }

    }

}

$x = new Trie();
$x->insert("Hello", new Person("John", "Doe"));
$x->insert("Hels", new Person("qqq", "www"));
$x->insert("JLo", new Person("Jo", "D"));
$x->retrieve("JLo");
//print_r($x);

echo "Deletion";
echo nl2br("\n");
$x->removeKey($x->getRoot(), "JLo");
print_r($x);
