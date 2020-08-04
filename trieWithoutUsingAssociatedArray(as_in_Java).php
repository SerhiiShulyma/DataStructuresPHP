<?php

class TrieNode
{
    public $data;
    public $isEnd;
    public $children=[];

    public function __construct()
    {
        $length=26;
        $this->isEnd=false;
        for($i=0; $i<$length; $i++){
            $this->children[$i]=null;
        }
    }
}

class Person
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name=$name;
        $this->age=$age;
    }
}

class Trie
{
    private $root;
    private $character;

    public function __construct()
    {
        $this->root =new TrieNode();
        $this->character = null;
    }

    /**
     * Get the value of root
     */ 
    public function getRoot()
    {
        return $this->root;
        
    }

    public function insert(string $key, Person $data)
    {
        $this->character=$this->root;
        $keyLength = strlen($key);
        for ($i=0; $i<$keyLength; $i++){
            $index=ord(substr($key, $i, 1)) - ord('a');
            if($this->character->children[$index]===null){
                $this->character->children[$index] = new TrieNode();
            }
            $this->character= $this->character->children[$index];
        }
        $this->character->isEnd=true;
        $this->character->data=$data;
        $this->character = null;
    }
    public function retrieve(string $key): bool
    {
        $this->character =$this->root;
        $keyLength = strlen($key);
        for($i=0; $i<$keyLength; $i++){
            $index = ord(substr($key, $i, 1)) - ord('a'); 
            if($this->character->children[$index]===null){
                $this->character = null;
                return false;
            }
            $this->character = $this->character->children[$index];
        }
        if ($this->character && $this->character->isEnd == true){
            return true;
        } else {
            $this->character = null;
            return false;
        }
    }

    private function notHasChildren(TrieNode $current): bool
    {
        for($i=0; $i<26; $i++){
            if($current->children[$i]!= null){
                return false;
            }
        }
        return true;
    }

    public function delete(TrieNode $current, string $key, $depth=0)
    {
        if($depth===0 && !$this->retrieve($key)){
            return false;
        } else {
            $keyLength = strlen($key);
            $index = ord(substr($key, $depth, 1)) - ord('a');
            if($keyLength===$depth){
                if($current->isEnd===true){
                    $current->isEnd = false;
                    $current->data =null;
                }
                if($this->notHasChildren($current)){
                    unset($current);
                    $current = null;
                }
                return $current;
            }
            $current->children[$index]=$this->delete($current->children[$index], $key, $depth+1);
            if($this->notHasChildren($current) && $current->isEnd === false){
                unset($current);
                $current = null;
            } 
            return $current;
        }

    }  
}

$x= new Trie();
$x->insert("hello", new Person("Serhii", 30));
$x->insert("heaaallo", new Person("231", 30));

// if($x->retrieve("hllo")){
//    echo "PRESENT"; 
// } else {
//    echo "ABSENT"; 
// }
$x->delete($x->getRoot(), "hello");
print_r($x);
/*
print_r($x);
*/