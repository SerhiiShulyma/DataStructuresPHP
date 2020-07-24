<?php

class TreeNode
{
    public $data;
    public $left;
    public $right;


    public function __construct($data=null)
    {
        $this->data=$data;
        $this->left=null;
        $this->right=null;
    }

    public function addChildren($left, $right)
    {
        $this->left=$left;
        $this->right=$right;
    }
} 

class BinaryTree
{
    private $root;
    private $traversalData = array();

    public function __construct()
    {
        $this->root = null;
    }
/**
 * Adding new Node to tree
 */
    public function insert($data)
    {
        $newNode = new TreeNode($data);
        if($this->root === null){
            $this->root = $newNode;
        } else {
            return $this->insertNode($newNode, $this->root);
        }
    }

/**
 * Recursive adding node
 */
    private function insertNode($node, $current)
    {
        try{
            $added = false;
            while($added === false){
                if($node->data < $current->data){
                    if($current->left === null){
                        $current->addChildren($node, $current->right);
                        $added= $node;
                    break;
                    } else{
                        $current = $current->left;
                        return $this->insertNode($node, $current);
                    }
                } else if($node->data >= $current->data){
                    if($current->right === null){
                        $current->addChildren($current->left, $node);
                        $added= $node;
                    break;
                    } else{
                        $current = $current->right;
                        return $this->insertNode($node, $current);
                    }
                } else {
                    throw new Exception("This is a bad data");
                    
                }
            }
            return $added;
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
/**
 * Searching Node in Tree
 */
    public function find($node)
    {
        try{
            if($this->root === null){
                throw new Exception("The Tree is empty");
                
            }
            $current = $this->root;
            if($current->data === $node->data){
                return $current;
            } else {
                return $this->findNode($node, $current);
            } 
        } catch(Exception $e){
            echo $e->getMessage();
        } 
        
    }
/**
 * Recursive searching in Tree
 */
    private function findNode($node, $current)
    {   try{
            $found = false;
            while($found === false){
                if($node->data < $current->data){
                    if($current->left === null){
                        throw new \Exception("There isn't such elements in Tree");
                    }else if($current->left && $current->left->data === $node->data){
                        $found = $current->left;
                    break; 
                    } else {
                        $current= $current->left;
                        return $this->findNode($node, $current);
                    }
                } else if($node->data > $current->data){
                    if($current->right === null){
                        throw new \Exception("There isn't such elements in Tree");
                    } else if($current->right && $current->right->data === $node->data){
                        $found = $current->right;
                    break; 
                    } else {
                        $current= $current->right;
                        return $this->findNode($node, $current);
                    }
                } else {
                    throw new \Exception("There isn't such elements in Tree");
                }
            }
            return $found;
        } catch(Exception $e){
            echo $e->getMessage();
        } 
    }
/**
 * Deleting Node in Tree
 */
    public function delete($element)
    {
        try{
            if($this->root === null){
                throw new Exception("The Tree is Empty");
            }
            $node = $this->find($element);
            if (!$node){
                throw new Exception("Empty element!!");
            }          
            if($this->root->data === $node->data){
            // if deleted node is root node, this node doesn' have parent!!!
                $parent =null; 
            } else {
                $parent = $this->getParent($node, $this->root);     
            }
            if($node->left ===null && $node->right ===null){
            //  delete leaf from tree
                if($parent->left && $parent->left->data === $node->data){
                    $parent->left =null;
                } else if ($parent->right && $parent->right->data === $node->data){
                    $parent->right =null;
                }
            } else if (($node->left && $node->right===null) || ($node->right && $node->left===null) ){
            //  delete node with one child from the tree  
                if($parent->left && $parent->left->data === $node->data){
                    if($node->left){
                        $parent->left =$node->left;
                    } else if($node->right){
                        $parent->left =$node->right;
                    }
                } else if ($parent->right && $parent->right->data === $node->data){
                    if($node->left){
                        $parent->right =$node->left;
                    } else if($node->right){
                        $parent->right =$node->right;
                    }
                }
            } else if($node->left && $node->right){
               //  delete node with two children from the tree  
                $minValueInRightSubtree= $this->findMinValueInRightSubTree($node);
                $parentForMinValueInRightSubtree = $this->getParent($minValueInRightSubtree, $this->root);
                if($minValueInRightSubtree->right){
                    // if we have right child for minValueInRightSubtree
                    $parentForMinValueInRightSubtree->left = $minValueInRightSubtree->right;
                } else{
                    // if we DON'T have right child for minValueInRightSubtree
                    $parentForMinValueInRightSubtree->left = null;
                }
                if($parent){
                    $minValueInRightSubtree->left =$node->left;
                    $minValueInRightSubtree->right =$node->right;           
                        if($parent->right->data === $node->data){
                            $parent->right = $minValueInRightSubtree;
                        } else if ($parent->left->data === $node->data){
                            $parent->left = $minValueInRightSubtree;
                        }
                } else {
                 // delete root node for binary tree !!!
                    $minValueInRightSubtree->left =$node->left;
                    $minValueInRightSubtree->right =$node->right;   
                    $this->root = $minValueInRightSubtree;
                }
                $node->left=null;
                $node->right=null;
            } else {
                throw new Exception("The wrong Element!!!");
            }
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
/**
 * Get Parent Node for Current Node
 */
    private function getParent($child, $current)
    {  
        try{
            $parent =false;
            while ($parent === false) {
                if($current->data > $child->data){
                    if($current->left && $current->left->data === $child->data){
                        $parent = $current;
                    break;
                    } else {
                        $current = $current->left;
                        return $this->getParent($child, $current);
                    }
                } else if($current->data <= $child->data){
                    if($current->right && $current->right->data === $child->data){
                        $parent = $current;
                    break;
                    } else {
                        $current = $current->right;
                        return $this->getParent($child, $current);
                    } 
                } else {
                    throw new \Exception("There isn't such elements in Tree");
                }     
            }
            return $parent;
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
/**
 * Find Node with Min Value for Current Node
 */
    private function findMinValueInRightSubTree($current)
    {
        $current= $current->right;
        while($current->left){
            $current = $current->left;
        }
        return $current;
    }
/**
 *InOrdered Tree Traversal
 * 
 */
    private function inOrderedTraversal($node)
    {
        if($node->left){
            $this->inOrderedTraversal($node->left);
        }
        $this->traversalData[] = $node->data;
        if($node->right){
            $this->inOrderedTraversal($node->right);
        }
    }
/**
 *postOrdered Tree Traversal
 * 
 */
private function postOrderedTraversal($node)
{
    if($node->left){
        $this->postOrderedTraversal($node->left);
    }
    if($node->right){
        $this->postOrderedTraversal($node->right);
    }
    $this->traversalData[] = $node->data;
}
/**
 *preOrdered Tree Traversal
 * 
 */
private function preOrderedTraversal($node)
{
    $this->traversalData[] = $node->data;
    if($node->left){
        $this->preOrderedTraversal($node->left);
    }
    if($node->right){
        $this->preOrderedTraversal($node->right);
    }
}
/***
 *  Show data at different Traversal
 */

    public function showTraversal($traversal='inordered')
    {
        try{
            switch($traversal){
                case 'inordered':
                    $this->inOrderedTraversal($this->root);
                    print_r($this->traversalData);
                    unset($this->traversalData);
                break;
                case 'postordered':
                    $this->postOrderedTraversal($this->root);
                    print_r($this->traversalData);
                    unset($this->traversalData);
                break;
                case 'preordered':
                    $this->preOrderedTraversal($this->root);
                    print_r($this->traversalData);
                    unset($this->traversalData);
                break;
                default:
                    throw new Exception("Wrong Traversal Type");                    
                break;
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}

$binaryTree = new BinaryTree();

$binaryTree->insert(15);
$binaryTree->insert(18);
$binaryTree->insert(16);
$binaryTree->insert(22);
$binaryTree->insert(20);
$binaryTree->insert(19);
$binaryTree->insert(28);
$binaryTree->insert(10);
$binaryTree->insert(9);
$binaryTree->insert(11);
$binaryTree->insert(14);
$binaryTree->insert(9.5);
$binaryTree->insert(19.5);

$element =  new TreeNode(18);
print_r($binaryTree);
//$element1 =  new TreeNode(11);
//$element2 =  new TreeNode(22);
$binaryTree->delete($element);
// $binaryTree->delete($element1);
// $binaryTree->delete($element2);

print_r($binaryTree);

echo nl2br("<br>");
echo nl2br("<br>");
echo nl2br("<br>");

$binaryTree->showTraversal('inordered');
echo nl2br("<br>");
echo nl2br("<br>");
$binaryTree->showTraversal('postordered');
echo nl2br("<br>");
echo nl2br("<br>");
$binaryTree->showTraversal('preordered');